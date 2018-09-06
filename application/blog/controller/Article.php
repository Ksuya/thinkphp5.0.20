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
}