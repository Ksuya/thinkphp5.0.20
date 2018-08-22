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
        $this->model['merchatWithdraw'] = model('MerchatWithdraw');
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
        return $this->model['merchatWithdraw']->bootstrapTable('a.*,b.name as merchat',[],[['merchat b','a.merchat_id = b.id','left']]);
    }

    public function changeWithdrawStatus()
    {
        $data = $this->request->only(['id','status']);
        return $this->model['merchatWithdraw']->saveData('处理商户流水',$data,['id'=>['in',$data['id']]],'chstatus');
    }
}