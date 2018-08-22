<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/21 22:06
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\model;
use app\common\model\Base;

class MerchatWithdraw extends Base{

    //-1- 被拒绝 0-处理中 1-处理成功 2-处理失败
    public function getStatusAttr($value)
    {
        switch ($value) {
            case '-1':
                return ['text'=>'已拒绝','value'=>$value];
            case '1':
                return ['text'=>'处理成功','value'=>$value];
            case '2':
                return ['text'=>'处理失败','value'=>$value];
            default:
                return ['text'=>'处理中','value'=>$value];
        }
    }


}