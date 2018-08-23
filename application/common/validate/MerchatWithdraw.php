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
        'orderAmount|提现金额' => 'require|decimal',
        'cardByName|持卡人姓名' => 'require|chs',
        'cardByNo|持卡人卡号' => 'require',
        'accType|结算类型' => 'require|number',
        'openBank|开户行' => 'chs',
        'openProvinve|开户行省' => 'chs',
        'openCity|开户行市' => 'chs',
    ];

    protected $message = [

    ];

    protected $scene = [
        'chstatus'   =>  ['status'],
        'withdraw'   =>  ['orderAmount','cardByName','cardByNo','accType','openBank','openProvinve','openCity'],
    ];

    public function __construct() {

    }
}