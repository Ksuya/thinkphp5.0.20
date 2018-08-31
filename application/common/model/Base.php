<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 14:44
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\model;
use app\index\controller\Redis;
use think\Exception;
use think\Log;
use think\Model;
use think\Request;
use think\Db;

class Base extends Model{

    public $pk = 'id';
    public $record = false;

    /**
     * @param string $actionName
     * @param $data
     * @param array $condition
     * @param string $scene
     * @return array
     * @throws \Exception
     */
    public function saveData($actionName = '', $data, $condition = [], $scene = '')
    {
        Db::startTrans();
        try {
            $request = Request::instance();
            // 旧数据信息
            $oldData = [];
            // 记录等级
            $recordLevel = 0;
            // 没有指明更新条件
            if(empty($condition)){
                // 新增数据表记录
                $recordLevel = 1;
                // 含有主键
                if(!empty($data[$this->pk])){
                    $condition = [$this->pk=>$data[$this->pk]];
                    // 更新数据表主键数据
                    $recordLevel = 2;
                    if($this->record){
                        $dataId = $data[$this->pk];
                        $oldData = $this->allowField(true)->findData(array_keys($data),$condition);
                        $oldData = $oldData['data'];
                    }
                }
            }else{
                // 如果更新条件中含有主键 就是更改单条记录
                if(isset($condition[$this->pk]) && !is_array($condition[$this->pk])){
                    // 更新数据表主键数据
                    $recordLevel = 2;
                    $dataId = $condition[$this->pk];
                    if($this->record) {
                        $oldData = $this->findData(array_keys($data), $condition);
                        $oldData = $oldData['data'];
                    }
                }else{
                    $dataId = '';
                    // 批量更新数据
                    $recordLevel = 3;
                    if($this->record) {
                        $oldData = $this->getColumn($condition,$this->pk);
                        $oldData = $oldData['data'];
                        $dataId = implode(',',$oldData);
                        $diff = $this->diffMultyArray($data,$condition);
                    }
                }
                if(isset($condition[$this->pk]) && isset($data[$this->pk])){
                    unset($data[$this->pk]);
                }
            }
            // 验证场景  写入数据
            if($scene){
                $scene = $this->name.'.'.$scene;
                $result = $this->validate($scene)->allowField(true)->save($data,$condition);
            }else{
                $result = $this->allowField(true)->save($data,$condition);
            }
            if($recordLevel == 1){
                $dataId = $this->getLastInsID($this->pk);
            }
            // 捕获异常信息
            if(false === $result){
                throw new Exception($this->getError());
            }
            // 记录Record  前提是表属性 record=true
            if($this->record){
                $recordData = [];
                $recordData['type'] = $recordLevel;
                $recordData['name'] = $actionName;
                $recordData['code'] = mt_rand(999,99999);
                $recordData['ip'] = $request->ip();
                $recordData['tableName'] = $this->name;
                $recordData['createTime'] = date('Y-m-d H:i:s');
                $recordData['user'] = session($request->module().'UserId');
                // 分析recordLevel等级
                switch ($recordLevel)
                {
                    case 1: // 新增记录
                        $recordData['dataId'] = $this->getLastInsID($this->pk);
                        // 插入数据到record表
                        $recordRes = model('Record')->insertGetId($recordData);
                        break;
                    case 2: // 主键更新
                        $recordData['dataId'] = $dataId;
                        // 插入数据到record表
                        $recordRes = model('Record')->insertGetId($recordData);
                        $diff = $this->diffArray($oldData,$data);
                        $detailAll = [];
                        if(!empty($diff['old']) && !empty($diff['new'])){
                            $old = $diff['old'];
                            $new = $diff['new'];
                            // 插入数据到record_detail表
                            $detail['recordId'] = $recordRes;
                            $detail['dataId'] = $dataId;
                            foreach ($old as $k => $v) {
                                $detail['fieldName'] = $k;
                                $detail['old'] = $v;
                                $detail['new'] = $new[$k];
                                $detailAll[] = $detail;
                            }
                        }
                        // 批量插入到record detail
                        $recordDetail = model('RecordDetail')->saveAll($detailAll);
                        break;
                    case 3: // 条件更新
                        $recordData['condition'] = serialize($condition);
                        $recordData['dataId'] = $dataId;
                        // 插入数据到record表
                        $recordRes = model('Record')->insertGetId($recordData);
                        $detailAll = [];
                        if(!empty($diff)){
                            foreach ($diff as $k => $v) {
                                foreach ($v as $field=>$value)
                                {
                                    if($field != $this->pk){
                                        $detail['recordId'] = $recordRes;
                                        $detail['dataId'] = $v[$this->pk];
                                        $detail['fieldName'] = $field;
                                        $detail['old'] = $value;
                                        $detail['new'] = $data[$field];
                                        $detailAll[] = $detail;
                                    }
                                }
                            }
                        }
                        // 批量插入到record detail
                        $recordDetail = model('RecordDetail')->allowField(true)->saveAll($detailAll);
                        break;
                    default:
                        break;
                }
            }
            Db::commit();
            return ['errcode' => '0', 'errmsg' => $actionName.lang('成功'), 'data' =>$dataId];
        } catch (Exception $e) {
            Db::rollback();
            appLog($e);
            return ['errcode' => '10056', 'errmsg' =>$e->getMessage()];
        }
    }

    /**
     * 比较前后数据
     * @param $oldData
     * @param $newData
     * @return array
     */
    private function diffArray($oldData, $newData)
    {
        $diff = [];
        $old = [];
        foreach ($oldData as $k => $v) {
            if (isset($newData[$k]) && $newData[$k] != $v) {
                $diff[$k] = $newData[$k];
                $old[$k] = $oldData[$k];
            }
        }
        return ['new' => $diff, 'old' => $old];
    }

    /**
     * @param $data
     * @param $condition
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function diffMultyArray($data, $condition)
    {
        // 新值得数组键
        $newKeys = $this->pk . ',' . implode(',', array_keys($data));
        // 旧值数据列表
        $oldVals = $this->where($condition)->field($newKeys)->select();
        $collection = [];
        foreach ($oldVals as $b) {
            $collection[] = $b->data;
        }
        return $collection;
    }

    /**
     * 查找一条数据
     * @param $field
     * @param array $condition
     * @param array $join
     * @param string $order
     * @param string $group
     * @param string $having
     * @return array
     */
    public function findData($field,$condition=[],$join=[],$order='',$group='',$having='')
    {
        try{
            $data = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->order($order)->find();
            if(!$data){
                throw new Exception('用户不存在');
            }
            return ['errcode'=>'0','data'=>$data];
        }catch(Exception $e){
            appLog($e);
            return ['errcode'=>'1002','errmsg'=>'find error'];
        }
    }

    /**
     * 删除数据
     * @param string $action
     * @param $condition
     * @return array
     */
    public function deleteData($action='删除',$condition)
    {
        try{
            if(empty($condition)){
                throw new Exception('删除时用户输入错误：'.json_encode($condition,JSON_UNESCAPED_LINE_TERMINATORS));
            }
            $this->where($condition)->delete();
            return ['errcode'=>'0','errmsg'=>$action.'成功','data'=>''];
        }catch(Exception $e){
            appLog($e);
            return ['errcode'=>'1003','errmsg'=>$action.'失败'];
        }
    }

    /**
     * 查找数据列表
     * @param $field
     * @param array $condition
     * @param array $join
     * @param string $order
     * @param int $offset
     * @param int $limit
     * @param string $group
     * @param string $having
     * @return array
     */
    public function dataList($field,$condition=[],$join=[],$order='',$offset=0,$limit=10,$group='',$having='')
    {
        try{
            $data = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->order($order)->limit($offset.','.$limit)->select();
            return ['errcode'=>'0','data'=>$data];
        }catch(Exception $e){
            appLog($e);
            return ['errcode'=>'1004','errmsg'=>'list error'];
        }
    }

    public function bootstrapTable($field,$condition=[],$join=[],$group='',$having='')
    {
        try{
            // 获取PHP input数据流
            $post = file_get_contents("php://input");
            $post = json_decode(base64_decode($post),true);
            $offset = $post['offset'];
            $limit = $post['limit'];
            $sort = $post['sort'];
            $order = $post['order'];
            if($sort){
                $order = $sort.' '.$order;
            }
            unset($post['offset']);
            unset($post['limit']);
            unset($post['sort']);
            unset($post['order']);
            if(isset($post['_time'])){unset($post['_time']);};
            if(isset($post['start'])){unset($post['start']);};
            if(isset($post['end'])){unset($post['end']);};
            // 处理搜索项
            foreach ($post as $k=>$v)
            {
                if(is_numeric($v)){
                    $condition[$k] = $v;
                }else{
                    $condition[$k] = ['like',"%$v%"];
                }
            }
            $total = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->count('a.'.$this->pk);
            $data = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->order($order)->limit($offset.','.$limit)->select();
            return base64_encode(json_encode(['total'=>$total,'rows'=>$data],true));
        }catch(Exception $e){
            appLog($e);
            return base64_encode(json_encode(['total'=>0,'rows'=>[],'message'=>'请求数据失败'],true));
        }
    }

    public function getPageList($field,$condition=[],$join=[],$order='',$group='',$having='')
    {
        try {
            $list = $this->alias('a')->field($field)->join($join)->group($group)->having($having)->where($condition)->order($order)->paginate(1,false,[
                'type'     => 'bootstrap',
                'var_page' => 'p',
            ]);
            $page = $list->render();
            $list = $list->toArray();
            $info = ['errcode' => '0', 'pageList' => $page, 'data' => $list['data'],'curPage'=>$list['current_page'],'total'=>$list['total'],'perPage'=>$list['per_page']];
            return $info;
        } catch (Exception $e) {
            echo $e->getMessage();exit;
            appLog($e);
            return ['errcode' => '10010', 'errmsg' => $e->getMessage()];
        }
    }

}