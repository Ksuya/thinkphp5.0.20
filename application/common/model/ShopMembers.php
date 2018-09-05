<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 12:55  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use think\Exception;
use tool\Algorithm;
class ShopMembers extends Base{
    public $record = true;

    /**
     * 密码加密处理
     * @param $value
     * @return string
     */
    public function setPasswordAttr($value)
    {
        return Algorithm::passport_encrypt($value);
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