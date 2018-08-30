<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 10:31
|--------------------------------------------------------------------------
| Description:
|
| 账户模块
*/
namespace app\manager\controller;
use app\manager\controller\MerchatBase;
use think\Request;

class Account extends MerchatBase{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model['merchat'] = model('Merchat');
        $this->model['merchatDetail'] = model('MerchatDetail');
        $this->model['merchatWithdraw'] = model('MerchatWithdraw');
        $this->model['merchatBank'] = model('MerchatBank');
        $this->model['systemGateway'] = model('SystemGateway');
    }

    /*
     * 商户基本信息
     */
    public function info()
    {
        // 获取商户信息
        $result = $this->model['merchat']->detail($this->merchatId);
        return view('',$result['data']);
    }

    /*
     * 更新商户详情
     */
    public function saveDetail()
    {
        return $this->model['merchatDetail']->saveData('更新详细信息',$this->request->post(),[]);
    }

    /*
    * 商户提现
    */
    public function withdraw()
    {
        // 获取商户银行卡信息
        $merBanks = $this->model['merchatBank']->where('merchatId',$this->merchatId)->select();
        $assign = compact('merBanks');
        return view('',$assign);
    }

    /*
     * 获取商户银行卡详情
     */
    public function getBankInfo()
    {
        $id = input("post.id");
        if(empty($id)){
            return ['errcode'=>'0','errmsg'=>'无效的银行卡'];
        }
        return $this->model['merchatBank']->findData('id as bankId,cardByName,cardByNo,openBank',['id'=>$id]);
    }

    /*
     * 商户提现数据
     */
    public function btData()
    {
        $dateCon = timeRange('start','end','a.createdTime');
        $con = array_merge($dateCon,['merchatId'=>$this->merchatId]);
        return $this->model['merchatWithdraw']->bootstrapTable('a.*,b.name as merchat',$con,[['merchat b','a.merchatId = b.id','left']]);
    }

    /**
     * 处理提现状态
     * @return mixed
     */
    public function changeWithdrawStatus()
    {
        $data = $this->request->only(['id','status']);
        return $this->model['merchatWithdraw']->saveData('处理商户提现流水',$data,['id'=>['in',$data['id']]],'chstatus');
    }

    /*
     * 保存提现胡数据
     */
    public function saveWithdraw()
    {
        $data = $this->request->only(['orderAmount','bankId','cardByName','cardByNo','openBank','openProvinve','openCity','accType']);
        $orderNo = $this->randomNumber();
        $data['merchatId'] = $this->merchatId;
        $data['transaction'] = $orderNo;
        return $this->model['merchat']->withdraw($data,3);
    }

}