<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 10:31
|--------------------------------------------------------------------------
| Description:
|
| 账户模块
*/
namespace app\merchat\controller;
use app\merchat\controller\MerchatBase;
use think\Request;

class Account extends MerchatBase{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model['merchat'] = model('Merchat');
        $this->model['merchatDetail'] = model('MerchatDetail');
    }

    /*
     * 商户基本信息
     */
    public function info()
    {
        $base = $this->model['merchat']->where('id',$this->merchatId)->find();
        $detail = $this->model['merchatDetail']->where('merchat_id',$this->merchatId)->find();
        $assign = compact('base','detail');
        return view('',$assign);
    }
}