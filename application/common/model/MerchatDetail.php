<?php
/*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 19:17
|--------------------------------------------------------------------------
| Description:
|
*/
namespace app\common\model;
use app\common\model\Base;

class MerchatDetail extends Base{


    public function getRegionAttr($value)
    {
        $city = explode(',',$value);
        $city[0] = isset($city[0]) ? $city[0] : '';
        $city[1] = isset($city[1]) ? $city[1] : '';
        $city[2] = isset($city[2]) ? $city[2] : '';
        return $city;
    }


}