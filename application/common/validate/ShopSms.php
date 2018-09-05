<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:35  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopSms extends Validate{

    protected $rule = [
        'reciver|接收人'  =>  'require|email',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['reciver','code'],
    ];

    public function __construct() {

    }

}