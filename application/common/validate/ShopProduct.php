<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 14:42  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopProduct extends Validate{

    protected $rule = [
        'id'  =>  'require|number',
        'brand_id|所属品牌'  =>  'number',
        'category_id|所属分类'  =>  'require|number',
        'name|商品名称' => 'require',
        'sort|商品排序' => 'require|number',
        'shop_price|店内价格' => 'require|decimal',
        'market_price|市场价格' => 'require|decimal',
        'stock|商品库存' => 'require|number',
        'posters|商品图片' => 'require|token:token_product_actions',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['category_id','brand_id','name'=>'require|unique:ShopProduct','sort','shop_price','market_price','stock','posters'],
        'upd'   =>  ['id','brand_id','category_id','name'=>'require|unique:ShopProduct,name^id','sort','shop_price','market_price','stock','posters'],
    ];

    public function __construct() {

    }
}