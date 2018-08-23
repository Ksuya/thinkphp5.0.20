<?php
// +----------------------------------------------------------------------
// | Time  : 17:48  2018/8/23/023
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// | 支付接口 所有上游支付必须完善此接口
// +----------------------------------------------------------------------
namespace payApi;
use MongoDB\Driver\Exception\WriteConcernException;
use think\Exception;

abstract class PayInterface{

    protected $_debug = [
        '1003'=>'商户号不能为空',
        '0000'=>'支付成功'
    ];

    private $_model = [];

    protected $_errCode = '1003';

    /**
     * 支付通道配置
     * @var array
     */
    protected $_config = [];

    /**
     * PayInterface constructor.
     * @param array $config
     */
    final function __construct()
    {
        // 初始化配置
        $this->initialize();
        // 订单模型
        $this->_model['order'] = model('SystemOrder');
        // 商户模型
        $this->_model['merchat'] = model('Merchat');
        // 商户支付通道模型
        $this->_model['gateway'] = model('SystemGateway');
        // 系统供应商模型
        $this->_model['supplire'] = model('SystemSupplire');
    }

    /**
     * 初始化支付通道配置
     * @return mixed
     */
    abstract function initialize();

    /**
     * 生成交易订单
     * 这个方法是固定的，不允许修改
     */
    public function insertOrder($order)
    {
        // 判断订单合法性
        if(empty($order['merCode'])){
            throw new Exception('商户号不能为空');
        }
        if(empty($order['gatewayId'])){
            throw new Exception('交易通道不能为空');
        }
        if(empty($order['orderNo'])){
            throw new Exception('订单号不能为空');
        }
        if(strlen($order['orderNo']) > 32){
            throw new Exception('订单号长度限制:32位');
        }
        if(empty($order['orderAmount'])){
            throw new Exception('订单金额不能为空:单位(元)');
        }
        if(empty($order['dateTime'])){
            throw new Exception('订单交易时间不能为空');
        }
        if(empty($order['sign'])){
            throw new Exception('签名不能为空');
        }
        // 获取商户所用通道费率信息
        $merchat = $this->_model['merchat']->where('signNumber',$order['merCode'])->field('id,name,signNumber,gateway,status')->find();
        if($merchat){
            throw new Exception('商户不存在');
        }
        if($merchat['status']['value'] != '1'){
            throw new Exception('商户被冻结');
        }
        $merWays = explode(',',$merchat['gateway']);
        if(!in_array($order['gatewayId'],$merWays)){
            throw new Exception('商户通道受限');
        }
        $gateway = $this->_model['gateway']->alias('a')->where('a.id',$order['gatewayId'])->field('a.serviceId,a.depositeRate,a.minAmount,a.maxAmount,b.merchatId as superMerocde,b.key as superKey')->join([['system_supplire b','a.serviceId = b.id','left']])->find();
        if($order['orderAmount'] < $gateway['minAmount']){
            throw new Exception('单笔交易最低:'.$gateway['minAmount']);
        }
        if($order['orderAmount'] > $gateway['maxAmount']){
            throw new Exception('单笔交易最高:'.$gateway['maxAmount']);
        }
        // 计算手续费
        $order['serviceCharge'] = $order['orderAmount'] * $gateway['depositeRate'];
        // 写入订单
        $this->_model['order']->allowField(true)->save($order);
        // 然后请求上游接口
        // 但是有些直接给支付URL  有些却得自己处理一下 这些还需要额外处理下
    }

    abstract function pay();


    final function unifiedOrder($order=[])
    {
        // 先插入订单到系统
        $this->insertOrder($order);
        // 返回支付信息
        $this->pay();
    }

    /**
     * 查询订单
     * @return mixed
     */
    final function orderQuery()
    {

    }

    /**
     * 退款
     * @return mixed
     */
    //public function refund(){};

    /**
     * 查询退款
     * @return mixed
     */
    //public function refundQuery(){};

    /**
     * 单笔代付
     * @return mixed
     */
    //public function agentOrder(){};

    /**
     * 代付查询
     * @return mixed
     */
    //public function agentOrderQuery(){};

}