<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 8:33
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\controller;
use think\Controller;
use think\Log;
use think\Request;
class Base extends Controller{

    public $model = [];
    public $token = null;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        // 记录上次访问链接
        $lastRequest = url($request->path());
        session('lastRequestUrl',$lastRequest);
        // 每次生成api_token
        $token = md5($request->domain().time().mt_rand(99,99999));
        session('api_token',$token);
        $this->assign("api_token",$token);
    }

    public function _initialize()
    {
        // 检查token是否有效
        if($this->request->isPost() || $this->request->isAjax())
        {
            $requestTime = $_SERVER['REQUEST_TIME'];
            if($requestTime < time()){
                echo json_encode(['errcode'=>'-1','errmsg'=>'REQUEST_TIME_OUT']);
                exit;
            }
            $refer = $_SERVER['HTTP_REFERER'];
            if(strpos($refer,$this->request->domain() === false)){
                echo json_encode(['errcode'=>'-1','errmsg'=>'REQUEST_INVALID_REQUEST']);
                exit;
            }
            /*$token = empty($_SERVER['HTTP_APITOKEN']) ? '' :  $_SERVER['HTTP_APITOKEN'];
            if($token !== session('api_token')){
                echo json_encode(['errcode'=>'-1','errmsg'=>'REQUEST_INVALID_TOKEN']);
                exit;
            }*/
        }
    }

    public function _empty($name)
    {
        return view();
    }


}