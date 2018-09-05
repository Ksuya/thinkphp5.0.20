<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 19:04  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Log;
use think\Validate;

class ShopOrderDetail extends Validate{

    protected $rule = [
        'order_id|订单总编号'  =>  'require|number',
        'product_id|订单商品'  =>  'require|number',
        'shop_price|商品店内价格' => 'require|decimal',
        'market_price|商品市场价格' => 'require|decimal',
        'number|购买数量' => 'require|number',
    ];

    protected $message = [

    ];

    protected $scene = [
        'order'   =>  ['order_id','product_id','shop_price','market_price','number'],
    ];

    public function __construct() {

    }


}