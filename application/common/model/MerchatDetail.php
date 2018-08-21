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
        if(!isset($city[2])){
            $city[2] = '';
        }
        return $city;
    }


}