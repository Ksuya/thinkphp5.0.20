<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 18:46  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use traits\model\SoftDelete;
use think\Exception;
use tool\Algorithm;
use tool\Kd100;
class ShopOrder extends Base{
    public $record = true;
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function getExpressIdAttr($value)
    {
        switch ($value)
        {
            case 'ems':
                return ['id'=>$value,'name'=>'ems快递'];
            case 'shentong':
                return ['id'=>$value,'name'=>'申通快递'];
            case 'yuantong':
                return ['id'=>$value,'name'=>'圆通速递'];
            case 'shunfeng':
                return ['id'=>$value,'name'=>'顺丰速运'];
            case 'tiantian':
                return ['id'=>$value,'name'=>'天天快递'];
            case 'yunda':
                return ['id'=>$value,'name'=>'韵达快递'];
            case 'zhongtong':
                return ['id'=>$value,'name'=>'中通速递'];
            case 'longbanwuliu':
                return ['id'=>$value,'name'=>'龙邦物流'];
            case 'zhaijisong':
                return ['id'=>$value,'name'=>'宅急送'];
            case 'deppon':
                return ['id'=>$value,'name'=>'德邦物流'];
            default:
                return ['id'=>$value,'name'=>'暂无物流'];
        }
    }


    public function getPayTypeAttr($value)
    {
        switch ($value){
            case '1':
                return ['id'=>$value,'name'=>'支付宝支付'];
            case '2':
                return ['id'=>$value,'name'=>'微信支付'];
        }
    }

    public function getStatusAttr($value)
    {
        switch ($value){
            case '1':
                return ['id'=>$value,'name'=>'支付成功'];
            default:
                return ['id'=>$value,'name'=>'未支付'];
        }
    }

    public function getProgressAttr($value)
    {
        switch ($value){
            case '1':
                return ['id'=>$value,'name'=>'等待发货'];
            case '2':
                return ['id'=>$value,'name'=>'已发货'];
            case '3':
                return ['id'=>$value,'name'=>'订单完成'];
            default:
                return ['id'=>$value,'name'=>'暂无'];
        }
    }

    public function detail($id)
    {
        // 订单详情
        $info = $this->alias('a')
            ->field('a.*,b.reciver,b.contact,b.region,b.address')
            ->where('a.id',$id)
            ->join([['shop_address b','a.address_id = b.id','left']])
            ->find()->toArray();
        // 订单物流
        if($info && $info['progress']['id'] > 1){
            $route = Kd100::getRoute($info['express_code'],$info['express_id']['id']);
            $info['route']  = $route;
        }
        // 订单商品
        $products = model('ShopOrderDetail')
            ->alias('a')
            ->field('a.*,b.name,c.path')
            ->where('a.order_id',$info['id'])
            ->join([['shop_product b','a.product_id = b.id','left'],['system_file c','b.posters = c.id','left']])
            ->select()->toArray();
        $info['products'] = $products;
        return $info;
    }
}