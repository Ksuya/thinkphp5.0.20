<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 14:22  2018/8/22/022
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace payApi\shanlefuPay;
class Lib{
    /**
     * @name 参数数组转换为url参数
     * @param array $urlObj
     */
    public function ToUrlParams($urlObj)
    {
        $buff = "";
        //按字典序排序参数
        ksort($urlObj);
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign" && $k != "signType" && strlen($v) > 0){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 生成签名
     * @param $s string
     * @return 签名
     */
    public function MakeSign($s)
    {
        //$string = $this->ToUrlParams($array);
        //print_r($string);
        //签名步骤三：MD5加密
        $string = md5($s);
        //签名步骤四：所有字符转为大写
        //$result = strtoupper($string);
        $result = $string;
        return $result;
    }
    /**
     * @name 验签
     * @param array $array 数组
     * @param string $key 密钥
     * @return bool
     */
    public function CheckSign($array,$key)
    {
        $string = $this->ToUrlParams($array);
        $s = md5($string.$key);
        if($array['sign'] == $s){
            return true;
        }
        echo "本地签名：".$s."<br/>";
        return false;
    }
    /**
     * 以post方式提交
     * @param string $url  url
     * @param string $s
     */
    public function postCurl($url,$s)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
        $output = curl_exec($ch);
        curl_close($ch);
        //返回array
        return json_decode($output,true);
    }
    /**
     * 以get方式提交
     * @param string $url
     */
    public function getCurl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //30秒超时
        $output = curl_exec($ch);
        curl_close($ch);
        //返回array
        return json_decode($output,true);
    }
}