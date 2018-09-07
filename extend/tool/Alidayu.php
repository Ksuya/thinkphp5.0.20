<?php
// +----------------------------------------------------------------------
// | Time  : 15:27  2018/9/7/007
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
class Alidayu{

    public static function send()
    {
        // 测试阿里大于短信
        import('alibaba.TopSdk',VENDOR_PATH);
        import('alibaba.top.request.AlibabaAliqinFcSmsNumSendRequest',VENDOR_PATH);
        date_default_timezone_set('Asia/Shanghai');
        $c = new \TopClient;
        $c->appkey = '24445485';
        $c->secretKey = '11727ee89adc7d03f786fa6c6d7deac3';
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("卓氏网络科技");
        $req->setSmsParam("{\"name\":\"TEST\",\"phone\":\"0352-88888888\"}");
        $req->setRecNum("15369197307");
        $req->setSmsTemplateCode("SMS_71350863");
        $resp = $c->execute($req);
        return $resp;
    }
}