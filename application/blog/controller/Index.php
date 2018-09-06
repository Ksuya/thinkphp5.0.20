<?php
// +----------------------------------------------------------------------
// | Time  : 16:33  2018/8/30/030
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\blog\controller;
use app\blog\controller\BlogBase;
class Index extends BlogBase{


    public function index()
    {
        // 获取排序靠前的5条内容
        $articles = $this->models['article']->field('id,title,description')->order('sort desc')->limit(10)->select()->toArray();
        return view('',['list'=>$articles]);
    }

    public function detail()
    {
        return view();
    }
}