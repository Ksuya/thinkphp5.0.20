<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 8:36
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\manager\controller;
use app\manager\controller\MerchatBase;
class Index extends MerchatBase{

    public function index()
    {
        // 这个判断是否有手动提现通道
        $isHandWithdraw = model('Merchat')->where('id',$this->merchatId)->value('gateway');
        $ways = explode(',',$isHandWithdraw);
        if(in_array(3,$ways)){
            $handWithdraw = true;
        }else{
            $handWithdraw = false;
        }
        return view('',['handWithdraw'=>$handWithdraw]);
    }
}