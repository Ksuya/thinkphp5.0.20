<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 16:39  2018/9/6/006
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class ShopCatelog extends Validate{

    protected $rule = [
        'id'  =>  'require|number',
        'parent_id|上级分类'  =>  'require|number',
        'title|文章名称' => 'require',
        'content|文章内容' => 'require',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['parent_id','name'=>'require|unique:ShopCatelog','title','content'],
        'upd'   =>  ['id','parent_id','name'=>'require|unique:ShopCatelog,name^id','title','content'],
    ];

    public function __construct() {

    }
}