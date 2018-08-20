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

class Base extends Model{

    public $pk = 'id';

    /**
     * 更新数据  add/update
     * @param string $action
     * @param $data
     * @param array $condition
     * @param bool $scene
     * @return array
     */
    public function saveData($action='save-data',$data,$condition=[],$scene=false)
    {
        try{
            $scene = false;
            if(empty($condition)){
                if(!empty($data[$this->pk])){
                    $condition = array_merge($condition,[$this->pk=>$data[$this->pk]]);
                }
            }
            if($scene){
                $scene = $this->name.$scene;
                $result = $this->validate($scene)->save($data,$condition);
            }else{
                $result = $this->save($data,$condition);
            }
            if(false === $result){
                throw new Exception($action.'失败；');
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
    public function deleteData($action='delete-data',$condition)
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

}