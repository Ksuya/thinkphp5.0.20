<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 12:57  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Log;
use think\Validate;

class ShopMembers extends Validate{

    protected $rule = [
        'email|电子邮箱'  =>  'require|email|',
        'phone|手机号'  =>  'require|mobile',
        'password|密码' => 'require|length:8,20',
        'repassword|确认密码' => 'require|confirm:password',
        'agree|同意用户注册协议' => 'require',
        'verify|验证码' => 'require|captcha|token:token_join_members',
        'code|验证码' => 'require',
        'nick_name|昵称' => 'require|length:6,12',
        'region|所在地区' => 'require',
        'address|详细地址' => 'chsAlpha',
        'real_name|真实姓名' => 'chs',
        'id_card|身份证号' => 'idCard',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['email'=>'require|email|unique:ShopMembers','phone'=>'require|mobile|unique:ShopMembers','password','repassword','verify','agree'],
        'modpwd'   =>  ['id','email'=>'require|email|unique:ShopMembers,email^id','password','code'=>'require|checkCode'],
        'upd'   =>  ['id','nick_name','region','id_card','real_name','address'],
    ];

    public function __construct() {

    }

    public function checkCode($value,$rule=[],$data)
    {
        Log::notice($data);
        $sms = model('ShopSms')->field('create_time,expires,code')->where('reciver',$data['email'])->find();
        if(!$sms){
            return '尚未发送邮件';
        }
        if(time() > (strtotime($sms['create_time'])+60*$sms['expires'])){
            return '验证码已经过期,请重新获取';
        }
        if($sms['code'] != $value){
            return '验证码错误';
        }
        return true;
    }
}