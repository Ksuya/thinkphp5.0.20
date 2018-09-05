<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 17:47  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\shop\controller\Shopbase;
use tool\Algorithm;
use think\Exception;
use tool\PHPEmail;
class Open extends Shopbase{
    public $models = [];

    public function _initialize()
    {
        parent::_initialize();
        $this->models['member'] = model('ShopMembers');
        $this->models['sms'] = model('ShopSms');
    }

    public function login()
    {
        return view();
    }

    public function register()
    {
        return view();
    }

    public function join()
    {
        $data = $this->request->post();
        // 生成用户昵称
        if(empty($data['nick_name'])){
            $data['nick_name'] = 'mem'.mt_rand(9,99999);
        }
        $result = $this->models['member']->saveData('注册账号',$data,[],'ist');
        $result['jump'] = url("/shop/open/login");
        return $result;
    }

    public function check()
    {
        try {
            $data = $this->request->post();
            if(empty($data['username'])){
                throw new Exception('请输入邮箱/手机号');
            }
            if(empty($data['password'])){
                throw new Exception('请输入密码');
            }
            $res = $this->models['member']->findData('a.*',['email|phone'=>$data['username']]);
            if($res['errcode'] != '0'){
                throw new Exception('用户不存在');
            }
            $user = $res['data'];
            if(Algorithm::passport_decrypt($user['password']) !== $data['password']){
                throw new Exception('密码错误');
            }
            session('shopUser',$user);
            session('shopUserId',$user['id']);
            return ['errcode' => '0', 'errmsg' => '登录成功','jump'=>url("/shop")];
        } catch (Exception $e) {
            appLog($e);
            return ['errcode' => '10326', 'errmsg' => $e->getMessage()];
        }
    }

    public function logout()
    {
        session('shopUser',null);
        session('shopUserId',null);
        $this->redirect(url('/shop'));
    }

    public function email()
    {
        $data = $this->request->post();
        $email = new PHPEmail();
        $code = mt_rand(1111,9999);
        $saveData = ['type'=>1,'reciver'=>$data['email'],'code'=>$code];
        if($sms = $this->models['sms']->where('reciver',$data['email'])->find('id')){
            $saveData['create_time'] = date('Y-m-d H:i:s');
            $saveData['id'] = $sms['id'];
        }
        $codeRes = $this->models['sms']->saveData('发送验证码',$saveData,[],'ist');
        if($codeRes['errcode'] != '0'){
            return $codeRes;
        }
        $res = $email->myEmail($data['email'],'找回密码','您的验证码是'.$code);
        if($res['errcode'] != '0'){
            return ['errcode' => '4545', 'errmsg' => '发送失败'];
        }
        return ['errcode' => '0', 'errmsg' => '发送成功'];
    }




    public function modify()
    {
        $data = $this->request->post();
        $data['email'] = empty($data['email']) ? '' : $data['email'];
        $id = $this->models['member']->where('email',$data['email'])->value('id');
        $data['id'] = $id;
        $res = $this->models['member']->saveData('找回密码',$data,[],'modpwd');
        $res['jump'] = url('/shop/open/login');
        return $res;
    }
}