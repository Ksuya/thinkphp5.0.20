<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 18:14  2018/9/6/006
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\validate;
use think\Validate;

class BlogArticle extends Validate{

    protected $rule = [
        'id'  =>  'require|number',
        'category_id|上级菜单'  =>  'require|number',
        'title|文章标题' => 'require',
        'keywords|文章标签' => 'require',
        'description|描述' => 'require',
        'sort|文章排序' => 'require|number',
        'poster|文章封面' => 'number',
        'content|文章内容' => 'require|token:token_category_actions',
    ];

    protected $message = [

    ];

    protected $scene = [
        'ist'   =>  ['category_id','title'=>'require|unique:BlogArticle','content'],
        'upd'   =>  ['id','category_id','name'=>'require|unique:BlogArticle,name^id','content'],
    ];

    public function __construct() {

    }
}