<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 14:17  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use traits\model\SoftDelete;

class ShopProduct extends Base{
    public $record = true;
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function detail($id)
    {
        return $this->alias('a')->field('a.name,a.shop_price,a.market_price,a.stock,a.sale_number,a.details,b.path')->join([['system_file b','a.posters = b.id','left']])->where('a.id',$id)->find()->toArray();
    }
}