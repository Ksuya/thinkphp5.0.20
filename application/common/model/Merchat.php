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

    public function detail($id)
    {
        try {
            // 商户基本信息
            $base = $this->where('id',$id)->find();
            // 商户通道
            $gateway = model('SystemGateway')->where('id','in',$base['gateway'])->select();
            // 商户资质信息
            $detail = model('MerchatDetail')->where('merchatId',$id)->find();
            // 订单笔数
            $orderNumber = model('SystemOrder')->where('merchatId',$id)->count('id');
            $base['orderNumber'] = $orderNumber;
            $result = compact('base','gateway','detail');
            return ['errcode' => '0', 'errmsg' => '', 'data' => $result];
        } catch (Exception $e) {
            appLog($e);
            return ['errcode' => '1007', 'errmsg' => $e->getMessage()];
        }
    }

    /**
     * 商户提现
     * @param $data
     * @return array
     * @throws \think\exception\PDOException
     */
    public function withdraw($data,$gatewayId)
    {
        $this->startTrans();
        try{
            // 提现任务
            $merchatInfo = $this->findData('id,balance,status',['id'=>session('merchatId')]);
            $merchatInfo = $merchatInfo['data'];
            // 获取通道限制
            $gateway = model('SystemGateway')->where('id',$gatewayId)->find();
            // 商户状态
            if($merchatInfo['status']['value'] != 1){
                throw new Exception('商户已经被冻结,请联系管理员');
            }
            // 余额是否大于提现金额
            if($data['orderAmount'] > $merchatInfo['balance']){
                throw new Exception('商户余额不足');
            }
            // 是否超限
            if($data['orderAmount'] < $gateway['minAmount']){
                throw new Exception('单笔交易最低限额: '.$gateway['minAmount']);
            }
            if($data['orderAmount'] > $gateway['maxAmount']){
                throw new Exception('单笔交易最高限额: '.$gateway['maxAmount']);
            }
            // 手续费（serviceCharge）
            $chargeFee = $data['orderAmount'] * $gateway['withdrawRate'];
            $data['serviceCharge'] = $chargeFee;
            $data['createdTime'] = date('Y-m-d H:i:s');
            $data['createdUser'] = session('userId');
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