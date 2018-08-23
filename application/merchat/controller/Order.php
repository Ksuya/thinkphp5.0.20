<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 10:33
|--------------------------------------------------------------------------
| Description:
| 商户订单信息
*/
namespace app\merchat\controller;
use app\merchat\controller\MerchatBase;
use think\Request;

class Order extends MerchatBase{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model['order'] = model('SystemOrder');
        $this->model['merchat'] = model('Merchat');
        $this->model['gateway'] = model('SystemGateway');
    }

    public function index()
    {
        $ways = $this->model['merchat']->where('id',$this->merchatId)->value('gateway');
        $gateways = $this->model['gateway']->where('id','in',$ways)->field('id,name')->select();
        $assign = compact('gateways');
        return view('',$assign);
    }

    public function merchatOrder()
    {
        $dateCon = timeRange('start','end','a.createdTime');
        $con = array_merge($dateCon,['merchatId'=>$this->merchatId]);
        return $this->model['order']->bootstrapTable('a.merchatId,a.gatewayId,a.orderNo,a.transaction,a.orderAmount,a.status,a.notifyNumber,a.bankCardType,a.bankCode,a.createdTime,b.name as gatewayName',$con,[['system_gateway b','a.gatewayId = b.id','left']]);
    }
}