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

    public function cate($id)
    {
        $list = model('ShopCategory')->where('parent_id',$id)->column('id');
        array_push($list,$id);
        $pros = model('ShopProduct')
            ->alias('a')
            ->where('category_id','in',$list)
            ->field('a.id,a.name,a.shop_price,b.path')
            ->join([['system_file b','a.posters = b.id','left']])
            ->paginate(12,false,[
                'type'     => 'bootstrap',
                'var_page' => 'page',
            ]);
        $page = $pros->render();
        $assign = compact('id','pros','page');
        return view('',$assign);
    }
}