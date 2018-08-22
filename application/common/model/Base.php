<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 14:44
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\model;
use think\Exception;
use think\Model;
use think\Request;

class Base extends Model{

    public $pk = 'id';
    public $record = false;

    /**
     * 更新数据  add/update
     * @param string $action
     * @param $data
     * @param array $condition
     * @param bool $scene
     * @return array
     */
    public function saveData($action='保存',$data,$condition=[],$scene=false)
    {
        try{
            if(empty($condition)){
                if(!empty($data[$this->pk])){
                    $condition = [$this->pk=>$data[$this->pk]];
                }
            }else{
                if(isset($condition[$this->pk]) && isset($data[$this->pk])){
                    unset($data[$this->pk]);
                }
            }
            if($scene){
                $scene = $this->name.'.'.$scene;
                $result = $this->validate($scene)->save($data,$condition);
            }else{
                $result = $this->save($data,$condition);
            }
            if(false === $result){
                throw new Exception($this->getError());
            }
            return ['errcode'=>'0','errmsg'=>$action.'成功'];
        }catch(Exception $e){
            appLog($e);
            return ['errcode'=>'1001','errmsg'=>$action.'失败；'];
        }
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
            $post = Request::instance()->post();
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
            $total = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->count();
            $data = $this->alias('a')->field($field)->join($join)->where($condition)->group($group)->having($having)->order($order)->limit($offset.','.$limit)->select();
            return ['total'=>$total,'rows'=>$data];
        }catch(Exception $e){
            appLog($e);
            return ['total'=>0,'rows'=>[],'message'=>'请求数据失败'];
        }
    }

}