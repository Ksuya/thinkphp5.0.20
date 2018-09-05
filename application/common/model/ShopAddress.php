<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 19:37  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use traits\model\SoftDelete;
class ShopAddress extends Base{
    public $record = true;
    protected $deleteTime = 'delete_time';

    public function getIsDefaultAttr($value)
    {
        switch ($value){
            case '1':
                return ['id'=>$value,'text'=>'是'];
            default:
                return ['id'=>$value,'text'=>'否'];
        }
    }

    public function getRegionAttr($value)
    {
        $value = explode(',',$value);
        $value[0] = empty($value[0]) ? '' : $value[0];
        $value[1] = empty($value[1]) ? '' : $value[1];
        $value[2] = empty($value[2]) ? '' : $value[2];
        return $value;
    }
}