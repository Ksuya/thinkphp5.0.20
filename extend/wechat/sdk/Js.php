<?php
/**
 * Created by whlphper.
 * User: Administrator
 * Date: 2018/5/18 0018
 * Time: 上午 10:13
 * Desc:
 */

namespace wechat\sdk;

use think\Cache;

/*
 * 微信官方js api
*/

class Js
{
    private $appid;
    private $appsecret;
    private $err = [
        '-1' => '系统繁忙，此时请开发者稍候再试',
        '0' => '请求成功',
        '40001' => 'AppSecret错误或者AppSecret不属于这个公众号，请开发者确认AppSecret的正确性',
        '40002' => '请确保grant_type字段值为client_credential',
        '40164' => '调用接口的IP地址不在白名单中，请在接口IP白名单中进行设置。（小程序及小游戏调用不要求IP地址在白名单内。）',
    ];

    public function __construct($appid, $appsecret)
    {

        $this->appid = $appid;
        $this->appsecret = $appsecret;
    }


    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新
        $ticket = Cache::get('jsapi_ticket');
        if (!$ticket) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            //$url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url), true);
            if (empty($res['ticket'])) {
                throw new \Exception($this->err[$res['errcode']]);
            }
            $ticket = $res['ticket'];
            if ($ticket) {
                Cache::set('jsapi_ticket', $ticket, 7200);
            }
        }
        return $ticket;
    }

    private function getAccessToken()
    {
        // access_token 应该全局存储与更新
        $access_token = Cache::get('js_access_token');
        if (!$access_token) {
            // 如果是企业号用以下URL获取access_token
            //$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appid&corpsecret=$this->appsecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
            $res = json_decode($this->httpGet($url), true);
            if (empty($res['access_token'])) {
                throw new \Exception($this->err[$res['errcode']]);
            }
            $access_token = $res['access_token'];
            if ($access_token) {
                Cache::set('js_access_token', $access_token, 7200);
            }
        }
        return $access_token;
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    private function get_php_file($filename)
    {
        if (!is_file($filename)) {
            $this->set_php_file($filename, '');
        }
        return trim(substr(file_get_contents($filename), 15));
    }

    private function set_php_file($filename, $content)
    {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
}