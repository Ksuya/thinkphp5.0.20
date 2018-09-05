<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 18:58  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Log;
use think\Validate;

class ShopOrder extends Validate{

    protected $rule = [
        'user_id|下单用户'  =>  'require|number',
        'order_no|订单号'  =>  'require',
        'order_amount|订单金额' => 'require|decimal',
        'pay_type|支付方式' => 'require|number',
        'address_id|收货地址' => 'require|number',
        'id|订单' => 'require|number',
    ];

    protected $message = [

    ];

    protected $scene = [
       'order'   =>  ['user_id','order_no'=>'require|unique:ShopOrder','order_amount'],
       'check'   =>  ['pay_type','address_id','id'],
    ];

    public function __construct() {

    }


}