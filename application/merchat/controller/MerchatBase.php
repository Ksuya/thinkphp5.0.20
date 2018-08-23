<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 8:35
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\merchat\controller;
use app\common\controller\Base;

class MerchatBase extends Base{

    public $model = [];
    public $userId;
    public $merchatId;
    public $merchatInfo;

    public function _initialize()
    {
        $userId = session('userId');
        $merchatId = session('merchatId');
        $merchatInfo = session('merchatInfo');
        if(!$userId || !$merchatId || !$merchatInfo){
            $url = url('Login/login');
            echo '<script>parent.location.href="'.$url.'"</script>';
            exit;
        }
        $this->merchatId = $merchatId;
        $this->userId = $userId;
        $this->merchatInfo = $merchatInfo;
    }

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