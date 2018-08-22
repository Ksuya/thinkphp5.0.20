<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/22 10:22
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\validate;
use think\Validate;

class MerchatWithdraw extends Validate{

    protected $rule = [
        'id'  =>  'require',
        'status'  =>  'require|number',
    ];

    protected $message = [

    ];

    protected $scene = [
        'chstatus'   =>  ['status'],
    ];

    public function __construct() {

    }
}