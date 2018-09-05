<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 8:35
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\manager\controller\merchat;
use app\common\controller\Base;

class MerchatBase extends Base{

    public $model = [];
    public $userId = 1;
    public $merchatId = 1;
    public $merchatInfo;



    public function randomNumber($leng=24)
    {
        $number = date('YmdHis').mt_rand(999,9999);
        $timeLength = strlen($number);
        if($leng <= $timeLength){
            return $number;
        }
        $diff = $leng - $timeLength;
        for($i=0;$i<$diff;$i++){
            $number .= mt_rand(0,9);
        }
        return $number;
    }
}