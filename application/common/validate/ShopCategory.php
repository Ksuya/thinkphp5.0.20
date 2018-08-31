<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 16:31  2018/8/31/031
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopCategory extends Validate{

    protected $rule = [
        'id'  =>  'require|number',
        'parent_id|上级菜单'  =>  'require|number',
        'name|菜单名称' => 'require',
        'sort|菜单排序' => 'require|number',
        'posters|菜单图片' => 'require|number|token:token_category_actions',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['parent_id','name'=>'require|unique:ShopCategory','sort','posters'],
        'upd'   =>  ['id','parent_id','name'=>'require|unique:ShopCategory,name^id','sort','posters'],
    ];

    public function __construct() {

    }
}