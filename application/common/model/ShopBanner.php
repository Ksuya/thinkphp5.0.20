<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 16:04  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use traits\model\SoftDelete;
class ShopBanner extends Base{
    protected $deleteTime = 'delete_time';

    public function getTypeAttr($value)
    {
        switch ($value){
            case '1':
                return ['id'=>$value,'name'=>'首页'];
            default:
                return ['id'=>null,'name'=>'位置'];
        }
    }
}