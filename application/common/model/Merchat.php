<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 19:17
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\model;
use app\common\model\Base;
use think\Exception;

class Merchat extends Base{

    public function getStatusAttr($value)
    {
        switch ($value)
        {
            case '1':
                return ['text'=>'正常','value'=>$value];
            case '2':
                return ['text'=>'冻结','value'=>$value];;
        }
    }


    public function withdraw($data)
    {
        $this->startTrans();
        try{
            // 提现任务
            $merchatInfo = $this->findData('id,balance,widthRate,status',['id'=>session('merchatId')]);
            $merchatInfo = $merchatInfo['data'];
            // 余额是否大于提现金额
            if($merchatInfo['status']['value'] != 1){
                throw new Exception('商户已经被冻结,请联系管理员');
            }
            if($data['orderAmount'] > $merchatInfo['balance']){
                throw new Exception('商户余额不足');
            }
            // 手续费（serviceCharge）
            $chargeFee = $data['orderAmount'] * $merchatInfo['widthRate'];
            $data['serviceCharge'] = $chargeFee;
            model('MerchatWithdraw')->saveData('提现任务提交',$data,[],'withdraw');
            // 减少商户余额（balance）  提现金额（orderAmount）+手续费（serviceCharge）
            $withTotal = $chargeFee+$data['orderAmount'];
            $this->where('id',$merchatInfo['id'])->setDec('balance',$withTotal);
            $this->commit();
            return ['errcode'=>'0','errmsg'=>'提现任务提交成功'];
        }catch(Exception $e){
            $this->rollback();
            appLog($e);
            return ['errcode'=>'10035','errmsg'=>$e->getMessage()];
        }
    }
}