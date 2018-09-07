<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 14:03  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\manager\controller\shop;
use app\manager\controller\ManagerBase;

class Product extends ManagerBase{
    public function _initialize()
    {
        $this->theme = '商品';
        $this->model = model('ShopProduct');
        $this->field = 'a.*,b.path as posters_path,c.name as cate_name,d.name as brand_name';
        $this->con = [];
        $this->join = [
            ['system_file b','a.posters = b.id','left'],
            ['shop_category c','a.category_id = c.id','left'],
            ['shop_brand d','a.brand_id = d.id','left'],
        ];
    }

    public function index()
    {
        // 获取所有分类
        $list = model('ShopCategory')->field('id,name,parent_id')->select();
        // 获取所有品牌
        $brand = model('ShopBrand')->field('id,name')->select();
        $list = getSubs($list,'parent_id');
        array_unshift($list,['id'=>0,'name'=>'顶级分类','parent_id'=>0]);
        return view('',['cates'=>$list,'brand'=>$brand]);
    }
}