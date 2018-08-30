<?php
// +----------------------------------------------------------------------
// | Time  : 19:06  2018/8/30/030
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\manager\controller;
use app\common\controller\Base;
use think\Request;

class Blog extends Base{

    public $models = [];

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->models['category'] = model('BlogCategory');
    }

    public function category()
    {
        $menus = $this->models['category']->field('id,name')->select();
        return view('',['menus'=>$menus]);
    }

    public function categoryList()
    {
        $dateCon = timeRange('start','end','a.create_time');
        $con = array_merge($dateCon,[]);
        return $this->models['category']->bootstrapTable('a.name,a.description,a.sort,a.is_menu,a.parent_id,a.create_time,b.name as parent_name',$con,[['blog_category b','a.parent_id = b.id','left']]);
    }
}