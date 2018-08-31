<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:50  2018/8/31/031
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
use traits\model\SoftDelete;

class ShopCategory extends Base{
    public $record = true;
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    public function getIsMenuAttrBak($value)
    {
        switch ($value)
        {
            case 1:
                return '是';
            case 0:
                return '否';
        }
    }
}