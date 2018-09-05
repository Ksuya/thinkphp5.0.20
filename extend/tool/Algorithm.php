<?php
// +----------------------------------------------------------------------
// | Time  : 15:48  2018/8/27/027
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
class Algorithm{

    /**
     * 加密
     * @param $txt
     * @param string $key
     * @return string
     */
    static function passport_encrypt($txt, $key = 'WHLPHPER')
    {
        srand((double)microtime() * 1000000);
        $encrypt_key = md5(rand(0, 32000));
        $ctr = 0;
        $tmp = '';
        for($i = 0;$i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
        }
        return urlencode(base64_encode(self::passport_key($tmp, $key)));
    }

    /**
     * 解密
     * @param $txt
     * @param string $key
     * @return string
     */
    static function passport_decrypt($txt, $key = 'WHLPHPER')
    {
        $txt = self::passport_key(base64_decode(urldecode($txt)), $key);
        $tmp = '';
        for($i = 0;$i < strlen($txt); $i++) {
            $md5 = $txt[$i];
            $tmp .= $txt[++$i] ^ $md5;
        }
        return $tmp;
    }

    static function passport_key($txt, $encrypt_key)
    {
        $encrypt_key = md5($encrypt_key);
        $ctr = 0;
        $tmp = '';
        for($i = 0; $i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
        }
        return $tmp;
    }
}