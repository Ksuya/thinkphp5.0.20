<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 10:33
|--------------------------------------------------------------------------
| Description:
| 安全设置
*/
namespace app\merchat\controller;
use app\merchat\controller\MerchatBase;
use think\Request;

class Security extends MerchatBase{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model['merchat'] = model('Merchat');
        $this->model['user'] = model('Users');
    }

    /**
     * 安全设置页面
     * @return \think\response\View
     */
    public function index()
    {
        $base = $this->model['merchat']->where('id',$this->merchatId)->field('signNumber,signKey,withdrawKey')->find();
        $assign = compact('base');
        return view('',$assign);
    }

    /**
     * 修改商户登录密码
     */
    public function modifyPwd()
    {
        $data = $this->request->post();
        if(empty($data['oldPassword'])){
            return ['errcode'=>'100801','errmsg'=>'请输入旧密码'];
        }
        if(empty($data['newPassword']) || empty($data['renewPassword'])){
            return ['errcode'=>'100802','errmsg'=>'请输入新密码'];
        }
        if($data['newPassword'] !== $data['renewPassword']){
            return ['errcode'=>'100803','errmsg'=>'两次密码不一致'];
        }
        $truePwd = $this->model['user']->where('id',$this->userId)->value('password');
        if(md5($data['oldPassword']) != $truePwd){
            return ['errcode'=>'100804','errmsg'=>'旧密码验证失败'];
        }
        $upData['password'] = md5($data['renewPassword']);
        $upData['token_mod_pwd'] = $data['token_mod_pwd'];
        return $this->model['user']->saveData('修改登录密码',$upData,['id'=>$this->userId],'modpwd');
    }

    /**
     * 修改商户提现密码
     */
    public function modifyWithdrawPwd()
    {
        $data = $this->request->post();
        if(empty($data['oldCommand'])){
            return ['errcode'=>'100801','errmsg'=>'请输入旧口令'];
        }
        if(empty($data['newCommand']) || empty($data['renewCommand'])){
            return ['errcode'=>'100802','errmsg'=>'请输入新口令'];
        }
        if($data['newCommand'] !== $data['renewCommand']){
            return ['errcode'=>'100803','errmsg'=>'两次口令不一致'];
        }
        $truePwd = $this->model['merchat']->where('id',$this->merchatId)->value('withdrawKey');
        if($data['oldCommand'] !== $truePwd){
            return ['errcode'=>'100804','errmsg'=>'旧口令验证失败'];
        }
        $upData['withdrawKey'] = $data['renewCommand'];
        $upData['token_mod_withpwd'] = $data['token_mod_withpwd'];
        return $this->model['merchat']->saveData('修改提现密码',$upData,['id'=>$this->merchatId],'modwithkey');
    }
}