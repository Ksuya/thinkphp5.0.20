<?php
// +----------------------------------------------------------------------
// | Time  : 15:30  2018/8/27/027
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
class RemoteInfo{
    private static $api = 'http://ip.taobao.com/service/getIpInfo.php';

    static function getIpInfo($ip)
    {
        $url = self::$api.'?ip='.$ip;
        $result = self::httpGet($url);
        if(!empty($result['errcode'])){
            echo 'ERROR: '.$result['errmsg'];
            exit;
        }
        $result = json_decode($result,true);
        if($result['code'] == 0){
            $idData['ip'] = $result['data']['ip'];
            $idData['country'] = $result['data']['country'];
            $idData['area'] = $result['data']['area'];
            $idData['region'] = $result['data']['region'];
            $idData['city'] = $result['data']['city'];
            $idData['isp'] = $result['data']['isp'];
            return ['errcode'=>'0','data'=>$idData];
        }else{
            return ['errcode'=>'9002002','errmsg'=>'invalid id'];
        }
    }

    private static function httpGet($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        // 执行并获取内容
        $output = curl_exec($ch);
        // 失败exit 输出错误码
        if (curl_errno($ch)) {
            curl_close($ch);
            return['errcode'=>'9002001','errmsg'=>curl_error($ch)];
        }
        // 释放curl句柄
        curl_close($ch);
        return $output;
    }
}