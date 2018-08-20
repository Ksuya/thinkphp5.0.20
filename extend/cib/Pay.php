<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/17 0017
 * Time: 18:11
 */
namespace cib;
use cib\ClientResponseHandler;
use cib\RequestHandler;
use cib\PayHttpClient;
use cib\Config;
use cib\Utils;
use think\Request;
class Pay{
    private $resHandler = null;
    private $reqHandler = null;
    private $pay = null;
    private $cfg = null;
    private $type = null;


    public function __construct(){
        $type = mt_rand(1,3);
        $this->type = 3;
        $this->Request();
    }

    public function Request(){
        $this->resHandler = new ClientResponseHandler();
        $this->reqHandler = new RequestHandler();
        $this->pay = new PayHttpClient();
        $this->cfg = new Config();
        echo '商户号：'.$this->cfg->C('mchId',$this->type).'<br />';
        $this->reqHandler->setGateUrl($this->cfg->C('url',$this->type));

        $sign_type = $this->cfg->C('sign_type',$this->type);

        if ($sign_type == 'MD5') {
            $this->reqHandler->setKey($this->cfg->C('key',$this->type));
            $this->resHandler->setKey($this->cfg->C('key',$this->type));
            $this->reqHandler->setSignType($sign_type);
        } else if ($sign_type == 'RSA_1_1' || $sign_type == 'RSA_1_256') {
            $this->reqHandler->setRSAKey($this->cfg->C('private_rsa_key',$this->type));
            $this->resHandler->setRSAKey($this->cfg->C('public_rsa_key',$this->type));
            $this->reqHandler->setSignType($sign_type);
        }
    }


    /**
     * 提交订单
     * @param $order
     */
    public function submitOrderInfo($order=[]){
        $this->reqHandler->setReqParams($order,array('method'));
        $this->reqHandler->setParameter('service','pay.alipay.native');//接口类型：pay.weixin.native  表示微信扫码
        // $this->reqHandler->setParameter('service','pay.alipay.native');//接口类型：pay.alipay.native  表示支付宝扫码
        // $this->reqHandler->setParameter('service','pay.jdpay.native');//接口类型：pay.jdpay.native   表示京东钱包扫码
        // $this->reqHandler->setParameter('service','pay.unionpay.native');//接口类型：pay.unionpay.native   表示银联钱包扫码
        $this->reqHandler->setParameter('mch_id',$this->cfg->C('mchId',$this->type));//必填项，商户号，由威富通分配
        $this->reqHandler->setParameter('version',$this->cfg->C('version',$this->type));
        $this->reqHandler->setParameter('sign_type',$this->cfg->C('sign_type',$this->type));
        // $this->reqHandler->setParameter('limit_credit_pay', '1');

        //通知地址，必填项，接收威富通通知的URL，需给绝对路径，255字符内格式如:http://wap.tenpay.com/tenpay.asp
        //$notify_url = 'http://'.$_SERVER['HTTP_HOST'];
        $this->reqHandler->setParameter('notify_url',$order['notify'].'?type='.$this->type);
        $this->reqHandler->setParameter('nonce_str',mt_rand(time(),time()+rand()));//随机字符串，必填项，不长于 32 位
        $this->reqHandler->createSign();//创建签名

        $data = Utils::toXml($this->reqHandler->getAllParameters());

        $this->pay->setReqContent($this->reqHandler->getGateURL(),$data);
        if($this->pay->call()){
            $this->resHandler->setContent($this->pay->getResContent());
            $this->resHandler->setKey($this->reqHandler->getKey());
            if($this->resHandler->isTenpaySign()){
                \think\Log::notice('兴业银行支付信息: 类型为 '.$this->type . ' ;data=' .json_encode($order));
                //当返回状态与业务结果都为0时才返回支付二维码，其它结果请查看接口文档
                if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){
                    return array('code_img_url'=>$this->resHandler->getParameter('code_img_url'),
                        'code_url'=>$this->resHandler->getParameter('code_url'),
                        'code_status'=>$this->resHandler->getParameter('code_status'),
                        'type'=>$this->reqHandler->getParameter('service'));
                    exit();
                }else{
                    //echo 'aaa<br/ >';
                    echo json_encode(array('status'=>500,'msg'=>'Error Code:'.$this->resHandler->getParameter('err_code').' Error Message:'.$this->resHandler->getParameter('err_msg')),JSON_UNESCAPED_UNICODE);
                    exit();
                }
            }
            //echo 'bbb<br/ >';
            echo json_encode(array('status'=>500,'msg'=>'Error Code:'.$this->resHandler->getParameter('status').' Error Message:'.$this->resHandler->getParameter('message')),JSON_UNESCAPED_UNICODE);
        }else{
            //echo 'ccc<br/ >';
            echo json_encode(array('status'=>500,'msg'=>'Response Code:'.$this->pay->getResponseCode().' Error Info:'.$this->pay->getErrInfo()),JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 提供给威富通的回调方法
     */
    public function callback($type=1){
        $xml = file_get_contents('php://input');
        //$res = Utils::parseXML($xml);
        $this->resHandler->setContent($xml);
        //var_dump($this->resHandler->setContent($xml));
        $this->resHandler->setKey($this->cfg->C('key',$type));
        if($this->resHandler->isTenpaySign()){
            if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){
                //echo $this->resHandler->getParameter('status');
                // 11;
                //更改订单状态
                $result['out_trade_no'] = $this->resHandler->getParameter('out_trade_no');
                $result['transaction_id'] = $this->resHandler->getParameter('transaction_id');
                $result['total_fee'] = $this->resHandler->getParameter('total_fee');
                \think\Log::notice('兴业银行支付成功,支付类型为'.$type.';信息: '.json_encode($result,true));
                return $result;
            }else{
                \think\Log::notice('兴业银行支付error: failure1');
                echo 'failure1';
                exit();
            }
        }else{
            echo 'failure2';
            \think\Log::notice('兴业银行支付error: signerror');
        }
    }
}