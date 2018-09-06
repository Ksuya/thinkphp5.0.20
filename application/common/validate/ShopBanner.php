<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:56  2018/9/6/006
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopBanner extends Validate{

    protected $rule = [
        'id'  =>  'require|number',
        'name|轮播名称' => 'require',
        'posters|轮播图片' => 'require|number|token:token_banner_actions',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['name'=>'require|unique:ShopBanner','posters'],
        'upd'   =>  ['id','name'=>'require|unique:ShopCategory,name^id','posters'],
    ];

    public function __construct() {

    }
}