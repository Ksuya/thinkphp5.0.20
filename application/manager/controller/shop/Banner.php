<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:50  2018/9/6/006
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\manager\controller\shop;
use app\manager\controller\ManagerBase;
class Banner extends ManagerBase{

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->theme = '轮播图';
        $this->model = model('ShopBanner');
        $this->field = 'a.*,b.path as posters_path';
        $this->con = [];
        $this->join = [['system_file b','a.posters = b.id','left']];
    }
}