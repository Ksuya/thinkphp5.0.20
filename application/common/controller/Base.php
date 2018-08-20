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
use think\Request;
class Base extends Controller{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        // 记录上次访问链接
        $lastRequest = url($request->path());
        session('lastRequestUrl',$lastRequest);
    }

    public function _initialize()
    {

    }

    public function _empty($name)
    {
        return view();
    }
}