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

class Merchat extends Base{

    public function getStatusAttr($value)
    {
        switch ($value)
        {
            case '1':
                return '正常';
            case '2':
                return '冻结';
        }
    }
}