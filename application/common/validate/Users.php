<?php
// +----------------------------------------------------------------------
// | Time  : 15:19  2018/8/23/023
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Users extends Validate{

    protected $rule = [
        'password|登录密码'  =>  'require|token:token_mod_pwd',
    ];

    protected $message = [

    ];

    protected $scene = [
        'modpwd'   =>  ['password'],
    ];

    public function __construct() {

    }
}