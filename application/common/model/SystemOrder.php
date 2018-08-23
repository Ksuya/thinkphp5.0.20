<?php
// +----------------------------------------------------------------------
// | Time  : 14:08  2018/8/23/023
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;

class SystemOrder extends Base{

    /**
     * 获取交易状态
     * @param $value
     * @return array
     */
    public function getStatusAttr($value,$data)
    {
        // 0000-支付成功  0001-提交，尚未支付  0002-支付失败   0003-通知失败  0004-已退款  0005-订单关闭
        switch ($value){
            case '0000':
                $res = ['text'=>'支付成功','val'=>$value];
                break;
            case '0001':
                $res = ['text'=>'已经提交','val'=>$value];
                break;
            case '0002':
                $res = ['text'=>'支付失败','val'=>$value];
                break;
            case '0003':
                $res = ['text'=>'通知失败','val'=>$value];
                break;
            case '0004':
                $res = ['text'=>'已经退款','val'=>$value];
                break;
            case '0005':
                $res = ['text'=>'订单关闭','val'=>$value];
                break;
            default:
                $res = ['text'=>'未知状态','val'=>$value];
        }
        return $res;
    }

    /**
     * 获取交易银行卡属性
     * @param $value
     * @return string
     */
    public function getBankCardTypeAttr($value,$data)
    {
        // 1-借记卡 2-信用卡
        switch ($value){
            case '1':
                return '借记卡';
            case '2':
                return '信用卡';
        }
    }

    /**
     * 获取交易银行机构
     * @param $value
     * @return string
     */
    public function getBankCodeAttr($value,$data)
    {
        return '建设银行';
    }
}