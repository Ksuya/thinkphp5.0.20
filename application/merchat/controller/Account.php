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

    public function saveDetail()
    {
        return $this->model['merchatDetail']->saveData('更新详细信息',$this->request->post(),[]);
    }

    public function btData()
    {
        return ['rows'=>[['name'=>'aa','age'=>20,'hh'=>'dsdsdsd'],['name'=>'aa','age'=>20,'hh'=>'dsdsdsd'],['name'=>'aa','age'=>20,'hh'=>'dsdsdsd']],'total'=>2];
    }
}