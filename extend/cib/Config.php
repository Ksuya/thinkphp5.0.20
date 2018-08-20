<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/17 0017
 * Time: 18:08
 */
namespace cib;
class Config{


    private $cfg1 = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'101540961388',
        'key'=>'0eb81e4a00eb793e7d261d79383ad5df',  /* MD5密钥 */
        'version'=>'1.0',
        'sign_type'=>'MD5',
    );

    private $cfg2 = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'101510959233',
        'key'=>'d6f8a9eceba53e874e089066327a3af3',  /* MD5密钥 */
        'version'=>'1.0',
        'sign_type'=>'MD5',
    );
    private $cfg3 = array(
        'url'=>'https://pay.swiftpass.cn/pay/gateway',
        'mchId'=>'101510959276',
        'key'=>'779f51adb4507b50de8196a2879cfdca',  /* MD5密钥 */
        'version'=>'1.0',
        'sign_type'=>'MD5',
    );

    public function C($cfgName,$type=1){
        $confName = 'cfg'.$type;
        $conf = $this->$confName;
        return $conf[$cfgName];
    }
}