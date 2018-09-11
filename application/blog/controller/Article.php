<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 20:13  2018/9/6/006
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\blog\controller;
use app\blog\controller\BlogBase;
class Article extends BlogBase{

    public function info($id)
    {
        $info = $this->models['article']->where('id',$id)->field('id,title,description,content,create_time')->find()->toArray();
        return view('',['info'=>$info]);
    }

    public function cate($cid=0)
    {
        $info = $this->models['catgeory']->where('id',$cid)->field('name,description,parent_id')->find()->toArray();
        $pid = $info['parent_id'];
        $cateId[] = $cid;
        if($pid != 0){
            $child = $this->models['catgeory']->where('parent_id',$cid)->column('id');
            $cateId = array_merge($cateId,$child);
        }
        $list = $this->models['article']->alias('a')->where('a.category_id','in',$cateId)->order('a.sort desc')->paginate(5,false,[
            'var_page'=>'p',
        ]);
        $page = $list->render();
        $assign = compact('info','list','page');
        return view('',$assign);
    }
}