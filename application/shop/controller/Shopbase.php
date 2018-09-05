<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 12:31  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\common\controller\Base;
class Shopbase extends Base{

    public $models = [];
    public function _initialize()
    {
        // 获取导航
        $allNav  = model('ShopCategory')->alias('a')->field('a.id,a.name,a.is_menu,a.parent_id,b.path')->join([['system_file b','a.posters = b.id','left']])->order('parent_id asc,sort desc')->select()->toArray();
        $this->allNav = $allNav;
        // 顶部显示
        $nav = [];
        foreach ($allNav as $k=>$v)
        {
            if($v['is_menu'] == 1){
                $nav[] = $v;
            }
        }
        // 所有导航
        $allNav = list_to_tree($allNav,'id','parent_id','subNav');
        // 获取底部
        $catelog = model('ShopCatelog')->field('id,parent_id,title')->select()->toArray();
        $catelog = list_to_tree($catelog,'id','parent_id','subLog');
        // 获取商城配置
        $cfg = model('ShopConfig')->getHashConf(1);
        $publicData = compact('nav','catelog','cfg','allNav');
        $this->assign($publicData);
    }

    public function checkUserSession()
    {
        if(!session("shopUser") || !session('shopUserId')){
            if($this->request->isAjax()){
                return ['errcode'=>'15954','errmsg'=>'请登录'];
            }
            $this->redirect(url('/shop/Open/login'));
        }
    }
}