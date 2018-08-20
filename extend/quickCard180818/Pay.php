<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/18 20:09
|--------------------------------------------------------------------------
| Description:
|
*/
namespace  quickCard180818;
use quickCard180818\Util;
use think\Exception;
use think\Log;

class Pay{

    private $mchId = 'A0001';
    private $key = '1234';
    private $md5key = '1234567812345678';

    public function submitOrder($order=[])
    {
        try{
            // 测试参数， 商户编号、签名密钥、加密密钥
            $zct = new Util($this->mchId, $this->key, $this->md5key);
            $data = array(
                "mchNo" => $zct->mercno,
                "payload" => "",
                "sign" => "",
            );
            $payload = array(
                // versionNo 接口版本号 【必填】 值固定为1
                "versionNo" => "1",
                // mchNo 机构号 必填 由平台统一分配
                "mchNo" => $zct->mercno,
                // price 交易金额, 单位：元
                "price" => empty($order['orderAmount']) ? 0.1 : $order['orderAmount'] ,
                // subject 商品名称
                "subject" => "subject_text",
                // description 订单描述
                "description" => "description_text",
                // orderDate 订单日期 yyyyMMddHHmmss
                "orderDate" => date('YmdHis',time()),
                // tradeNo 商户流水号
                "tradeNo" => empty($order['orderNo']) ? date('YmdHis').mt_rand(999,99999) : $order['orderNo'] ,
                // notifyUrl 异步通知URL
                "notifyUrl" => $order['notify'],
                // callbackUrl  页面回跳地址
                "callbackUrl" => $order['pickUrl'],
                // payType 支付方式。01、02
                "payType" => "01",
                // payBankCode 支付银行编码
                "payBankCode" => ""//01030000
            );
            echo '<pre />';
            print_r($payload);
            $plainReqPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);

            $data["payload"] = $zct->aesEncrypt($plainReqPayload);
            $data["sign"] = $zct->md5($data["payload"]);

            echo "<h1>"."外发请求信息</h1>";
            echo "<div class='debug-info'><h3>"."业务报文: </h3><p>" . $plainReqPayload . "</p></div><br/>";
            echo "<div class='debug-info'><h3>"."请求报文: </h3><p>" . json_encode($data, JSON_UNESCAPED_UNICODE) . "</p></div><br/>";

            echo "<h1>"."返回信息</h1>";
            $respstring = $zct->doPost($zct->CREATE_MERCHANT, $data);
            echo "<div class='debug-info'><h3>"."返回数据报文：</h3><p> " . $respstring;

            $respData = json_decode($respstring, true);
            echo "<div class='debug-info'><h3>"."返回状态信息</h3><p>state=" . $respData["state"] . ", code=" . $respData["code"] . ", message=" . $respData["message"] . "</p></div><br>";

            // 交易成功、受理、失败
            if($respData["state"] == 'Successful') {
                $respEncPayload = $respData["payload"];
                $respsignature = $respData["sign"];
                echo "<div class='debug-info'><h3>"."返回密文数据: </h3><p>" . $respEncPayload . "</p></div><br>";
                echo "<div class='debug-info'><h3>"."验签结果： </h3><p>" . ($respsignature == $zct->md5($respEncPayload) ? "成功" : "失败") . "</p></div>";

                $respPlainPayload = $zct->aesDecrypt($respEncPayload);
                echo "<div class='debug-info'><h3>"."返回业务数据: </h3><p>" . $respPlainPayload . "</p></div><br>";
                if($respsignature == $zct->md5($respEncPayload)) {
                    $respPayload = json_decode($respPlainPayload, true);
                    echo "<div class='debug-info'><h3>"."注册状态: </h3><p>" . $respPayload["status"] . "</p></div><br>";
                }
            }
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public function notify()
    {
        try{
            $data = input("post.");
            Log::notice('quickPay180818 notify data');
            Log::notice($data);
            if($data['status'] == '00'){
                Log::notice('quickPay180818 success  orderNo='.$data['tradeNo']);
                return ['orderNo'=>$data['tradeNo'],'transactionId'=>$data['transNo'],'orderAmount'=>$data['price']];
            }elseif ($data['status'] == '02'){
                Log::notice('quickPay180818 failure');
                return false;
            }else{
                Log::notice('quickPay180818 failure no 00 no 02');
                return false;
            }
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }

    }
}