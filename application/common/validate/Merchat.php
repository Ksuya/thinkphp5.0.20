<?php
// +----------------------------------------------------------------------
// | Time  : 16:04  2018/8/23/023
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class Merchat extends Validate{

    protected $rule = [
        'withdrawKey|提现密码'  =>  'require|token:token_mod_withpwd',
    ];

    protected $message = [

    ];

    protected $scene = [
        'modwithkey'   =>  ['withdrawKey'],
    ];

    public function __construct() {

    }
}