<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 12:34  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\shop\controller\Shopbase;
class Index extends Shopbase{

    public function index()
    {
        // 获取banner
        $banner = model('ShopBanner')->alias('a')->field('a.*,b.path')->where('a.type',1)->join([['system_file b','a.posters = b.id','left']])->select()->toArray();
        // 获取四大分类以及商品
        $navs = $this->allNav;
        $showNav = [];
        foreach ($navs as $k=>$v)
        {
            if($v['parent_id'] == 0 && count($showNav) < 4){
                $v['childs'] = [];
                $v['sub'] = [];
                foreach ($navs as $k2=>$v2)
                {
                    if($v2['parent_id'] == $v['id']){
                        $v['childs'][] = ['id'=>$v2['id'],'name'=>$v2['name']];
                        $v['sub'][] = $v2['id'];
                    }
                }
                $showNav[] = $v;
            }
        }
        foreach ($showNav as $k=>$v)
        {
            array_push($v['sub'],$v['id']);
            $produscts = model('ShopProduct')->alias('a')->where('category_id','in',$v['sub'])->field('a.id,a.name,a.shop_price,a.market_price,a.posters,b.path')->join([['system_file b','a.posters = b.id','left']])->select()->toArray();
            $showNav[$k]['products'] = $produscts;
        }

        $assign = compact('banner','showNav');
        return view('',$assign);
    }

    public function help($id=12)
    {
        $info = model('ShopCatelog')->field('id,title,content')->where('id',$id)->find();
        return view('',['info'=>$info,'id'=>$id]);
    }
}