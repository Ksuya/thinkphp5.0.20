<?php

namespace app\index\controller;

use quickCard180818\Pay as qkPay;
use think\Request;
use bootstrap\Form;
use tool\PHPCurl;

class Index
{
    public function index()
    {
        return view();
    }

    public function pay()
    {
        $url = 'http://pay.ztgame.com/action.php';
        $seq = mt_rand(100000000,999999999).'.'.mt_rand(1000000,9999999);
        $params = [
            'pay-seq' => $seq,
            'bank' => 'ICBC',
            'act' => 'qfillfromwxpay',
            'account' => 'zt2018',
            'fee' => 10,
            'acctype' => 'jr',
            'payclient' => 'pc',
        ];
        $params = http_build_query($params);
        $header = [
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Cookie: PHPSESSID=b4k5j9u97b1ls8gqhq20lmkeol; NSC_ooi-qbz_w4_bm=ffffffffaf167a7145525d5f4f58455e445a4a421502; amount-qrcode=10; lg_ucd=566b1cca75f82b848c540db2a447bbb1dde3cc38fa68ed31544f9447429d47cba%3A2%3A%7Bi%3A0%3Bs%3A6%3A%22lg_ucd%22%3Bi%3A1%3Bs%3A26%3A%22m4u7a4mkpgoct4ka86v258ttn1%22%3B%7D; channel-ebank=wechat; pay-account=zt2018; pay-seq='.$seq,
            'Referer: http://pay.ztgame.com/',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'
        ];
        $res = PHPCurl::curl($url, 'POST',$params,$header);
        dump($res);
    }
}
