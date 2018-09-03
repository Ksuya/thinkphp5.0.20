<?php
// +----------------------------------------------------------------------
// | Time  : 15:41  2018/8/31/031
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\manager\controller\shop;
use app\common\controller\Base;

class ShopBase extends Base{

    public $theme;
    public $model;
    public $field;
    public $con = [];
    public $join = [];

    public function dataList()
    {
        $dateCon = timeRange('start','end','a.create_time');
        $con = array_merge($dateCon,$this->con);
        return $this->model->bootstrapTable($this->field,$con,$this->join);
    }

    public function store()
    {
        $data = $this->request->post();
        if(!empty($data['id'])){
            $scene = 'upd';
            $name = $this->theme.'更新';
        }else{
            $scene = 'ist';
            $name = '新增'.$this->theme;
        }
        return $this->model->saveData($name,$data,[],$scene);
    }

    public function delData()
    {
        $id = $this->request->post('id');
        return $this->model->deleteData('删除'.$this->theme,['id'=>['in',$id]]);
    }
}