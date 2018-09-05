<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 13:50  2018/9/5/005
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopAddress extends Validate{

    protected $rule = [
        'user_id|用户'  =>  'require|number',
        'reciver|收件人'  =>  'require',
        'contact|联系方式'  =>  'require|mobile',
        'region|所在地区'  =>  'require',
        'address|详细地址'  =>  'require',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['user_id','reciver'=>'require|unique:ShopAddress,reciver^user_id','contact','region','address'],
        'upd'   =>  ['user_id','reciver'=>'require|unique:ShopAddress,reciver^user_id','contact','region','address'],
    ];

    public function __construct() {

    }

}