<?php
// +----------------------------------------------------------------------
// | Time  : 19:06  2018/8/29/029
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
class PHPSoap{

    // header 驗證
    public function auth($auth){
        if($auth->string[0]!='fdipzone' || $auth->string[1]!='654321'){
            throw new SOAPFault('Server', 'No Permission');
        }
    }

    // 反轉字符串
    public function revstring($str=''){
        return strrev($str);
    }

    // 字符傳轉連接
    public function strtolink($str='', $name='', $openwin=0){
        $name = $name==''? $str : $name;
        $openwin_tag = $openwin==1? ' target="_blank" ' : '';
        return sprintf('<a href="%s" %s>%s</a>', $str, $openwin_tag, $name);
    }

    // 字符串轉大寫
    public function uppcase($str){
        return strtoupper($str);
    }

}