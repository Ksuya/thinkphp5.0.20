<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 14:27  2018/8/22/022
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace payApi\shanlefuPay;
use payApi\PayInterface;
use payApi\shanlefuPay\Lib;
use think\Log;
use think\Request;
ini_set('date.timezone', 'Asia/Shanghai');
error_reporting(E_ERROR);
class Pay extends PayInterface{

    public function initialize()
    {
        $config['apiRoot'] = 'http://47.104.25.95:8083/trade';
        $config['payUrl'] = '/api/ebankPay';
        $config['queryUrl'] = '/api/queryPay';
        $config['signType'] = 'MD5';
        $config['charset'] = 'UTF-8';
        $config['mchId']  = '152017121000013';
        $config['md5Key'] = '2cc6341354b840f6b71fba69b2bfba3a';
        $this->_config = $config;
    }

    public function pay($order=[])
    {
        $key = $this->_config['md5key'];
        $url = $this->_config['apiRoot'].$this->_config['payUrl'];
        $map = array(
            'service' => 'ebankPay',
            'signType'=> $this->_config['signType'],
            'inputCharset' => $this->_config['charset'],
            'sysMerchNo' => $this->_config['mchId'],
            'outOrderNo' => $order['orderNo'],
            'orderTime' => date("YmdHis"),
            'orderAmt' => $order['orderAmount'],
            'orderTitle' => '入金',
            'clientIp' => Request::instance()->ip(),
            'frontUrl' => $order['pickUrl'],
            'backUrl' => $order['notify'],
            'selectFinaCode' => $order['selectFinaCode'],//$_POST['selectFinaCode'],CCB
            'tranAttr' => $order['tranAttr'],//$_POST['tranAttr'],'DEBIT',
            'settleCycle' => 'T0',//$_POST['settleCycle'],
        );

        $util = new Lib();
        $param = $util->ToUrlParams($map);
        $sign = $util->MakeSign($param.$key);//签名字符串
        $result = $util->postCurl($url,$param."&sign=".$sign);
        if($util->CheckSign($result,$key)){
            Log::notice('Slf pay sign success; orderNo= '.$order['orderNo']);
        }else{
            Log::notice('Slf pau sign error');
        }
        foreach ($result as $k =>$v){
            echo $k."：".$v."<br />";
        }
    }

    public function notify()
    {
        //分配的商户密钥
        $key = $this->key;
        Log::notice('shanlefuPay notify::');
        $arr = array(
            'signType' => $_POST['signType'],
            'sign' => $_POST['sign'],
            'inputCharset' => $_POST['inputCharset'],
            'tranNo' => $_POST['tranNo'],
            'tranTime' => $_POST['tranTime'],
            'oriTranNo' => $_POST['oriTranNo'],
            'sysMerchNo' => $_POST['sysMerchNo'],
            'outOrderNo' => $_POST['outOrderNo'],
            'oriOrderNo' => $_POST['oriOrderNo'],
            'orderTime' => $_POST['orderTime'],
            'orderAmt' => $_POST['orderAmt'],
            'tranAttr' => $_POST['tranAttr'],
            'tranSubAttr' => $_POST['tranSubAttr'],
            'tranAmt' => $_POST['tranAmt'],
            'tranResult' => strtolower($_POST['tranResult']),
        );
        Log::notice('shanlefuPay notify data:');
        Log::notice($arr);
        if($arr['tranResult'] == 'success'){
            Log::notice('shanlefuPay 成功');
            Log::notice("shanlefuPay 返回验签：暂时跳过");
            return ['orderNo'=>$arr['outOrderNo'],'orderAmount'=>$arr['orderAmt'],'transactionId'=>$arr['tranNo']];
            $util = new Lib();
            if($util->CheckSign($arr,$key)){
                Log::notice("shanlefuPay 返回验签：成功");
                return ['orderNo'=>$arr['outOrderNo'],'orderAmount'=>$arr['orderAmt'],'transactionId'=>$arr['tranNo']];
            }else{
                Log::notice("shanlefuPay 返回验签：失败");
                return false;
            }

        }else{
            Log::notice('shanlefuPay 失败');
            return false;
        }

    }

    public function queryPay($orderNo='')
    {
        $key = $this->key;
        $url = $this->testQuerypayUrl;
        $map = array(
            'service' => 'queryPay',
            'signType'=> $this->signType,
            'inputCharset' => $this->inputCharset,
            'sysMerchNo' => $this->sysMerchNo,
            'tranNo' => '',
            'outOrderNo' => $orderNo,
        );

        $util = new Lib();
        $param = $util->ToUrlParams($map);
        $sign = $util->MakeSign($param.$key);//签名字符串
        $result = $util->postCurl($url,$param."&sign=".$sign);
        //echo "返回结果<br />";
        if($util->CheckSign($result,$key)){
            //echo "返回验签：成功<br />";
        }else{
            //echo "返回验签：失败<br />";
        }
        if($result['retCode'] === '0000'){
            switch ($result['orderStatus']){
                case '02':
                    $msg = '支付成功';
                    break;
                case '01':
                    $msg = '已经提交,等待支付';
                    break;
                case '05':
                    $msg = '支付失败';
                    break;
                case '06':
                    $msg = '订单关闭';
                    break;
                case '07':
                    $msg = '订单不存在';
                    break;
                default:
                    $msg = '未知的状态';
                    break;
            }
            return ['orderNo'=>$result['outOrderNo'],'msg'=>$msg];
        }
        return false;
    }
}