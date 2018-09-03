<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 17:17  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\shop\controller\Shopbase;
class Product extends Shopbase{

    public function detail($id)
    {
        $info = model('ShopProduct')->detail($id);
        return view('',['info'=>$info]);
    }
}