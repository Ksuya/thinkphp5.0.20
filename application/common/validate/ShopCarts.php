<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 17:19  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopCarts extends Validate{

    protected $rule = [
        'user_id|用户'  =>  'require|number',
        'product_id|商品'  =>  'require|number',
        'number|商品数量'  =>  'require|number',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['user_id','product_id'=>'require|unique:ShopCarts,product_id^user_id','number'],
    ];

    public function __construct() {

    }

}