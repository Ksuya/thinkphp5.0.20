<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 17:16  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;

class ShopCarts extends Base{

    public function getUserCarts($userId)
    {
        return $this
            ->alias('a')
            ->field('a.id,a.product_id,a.number,b.name,b.shop_price,b.market_price,b.stock,c.path')
            ->where('user_id',$userId)
            ->join([['shop_product b','a.product_id = b.id','left'],['system_file c','b.posters = c.id','left']])
            ->order('a.create_time desc')
            ->select()
            ->toArray();
    }
}