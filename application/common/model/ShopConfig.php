<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 15:17  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\common\model;
use app\common\model\Base;
class ShopConfig extends Base{
    public $record = true;
    protected $deleteTime = 'delete_time';

    public function getHashConf($type=1)
    {
        $config = [];
        $list = $this->where('config_id','in',$type)->field('name,value')->select();
        foreach ($list as $k=>$v)
        {
            $config[$v['name']] = $v['value'];
            if($v['name'] == 'site_logo'){
                $config[$v['name'].'_path'] = model('SystemFile')->where('id',$v['value'])->value('path');
            }
        }
        return $config;
    }
}
