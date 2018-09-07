<?php
// +----------------------------------------------------------------------
// | IUBO    PHP
// +----------------------------------------------------------------------
// | Time  : 12:34  2018/9/3/003
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\shop\controller;
use app\shop\controller\Shopbase;
use think\Db;
use think\Request;
use tool\PHPExcle;
class Index extends Shopbase{

    public function index()
    {
        
        /*$data = PHPExcle::readFile(ROOT_PATH.'sjt.xls',['sale_number','name','shop_price','configure','posters']);

        foreach ($data as $k=>$v){
            $path = '/resource/uploads/product/20180907/'.md5(time().mt_rand(9,9999));
            $res = $this->grabIamge('http:'.$v['posters'],ROOT_PATH.'/public'.$path);
            if(!$res){
                echo 'download error';
                break;
            }
            $poster = model('SystemFile')->insertGetId(['name'=>$k.'import','path'=>$path.'.jpg']);
            $data[$k]['posters'] = $poster;
            $data[$k]['market_price'] = $v['shop_price']+mt_rand(80,250);
            $data[$k]['category_id'] = 4;
        }
        model('ShopProduct')->insertAll($data);*/
        
        // 获取banner
        $banner = model('ShopBanner')->alias('a')->field('a.*,b.path')->where('a.type',1)->join([['system_file b','a.posters = b.id','left']])->select()->toArray();
        // 获取四大分类以及商品
        $navs = $this->allNav;
        $showNav = [];
        foreach ($navs as $k=>$v)
        {
            if($v['parent_id'] == 0 && count($showNav) < 4){
                $v['childs'] = [];
                $v['sub'] = [];
                foreach ($navs as $k2=>$v2)
                {
                    if($v2['parent_id'] == $v['id']){
                        $v['childs'][] = ['id'=>$v2['id'],'name'=>$v2['name']];
                        $v['sub'][] = $v2['id'];
                    }
                }
                $showNav[] = $v;
            }
        }
        foreach ($showNav as $k=>$v)
        {
            array_push($v['sub'],$v['id']);
            $produscts = model('ShopProduct')->alias('a')->where('category_id','in',$v['sub'])->field('a.id,a.name,a.shop_price,a.market_price,a.posters,b.path')->join([['system_file b','a.posters = b.id','left']])->limit(10)->select()->toArray();
            $showNav[$k]['products'] = $produscts;
        }

        $assign = compact('banner','showNav');
        return view('',$assign);
    }

    function grabIamge($url, $filename = '')
    {
        if (empty($url)) {
            echo 'empty url';
            exit;
        }
        // 获取文件后缀  含.
        $ext = strrchr($url, '.');
        if (empty($filename)) {
            if ($ext != '.jpg' && $ext != 'jpeg' && $ext != 'png') {
                echo 'not image file';
                exit;
            }
            $filename = date('YmdHis') . $ext;
        } else {
            $filename .= $ext;
        }
        // 开启输出
        ob_start();
        // 输出图片文件
        readfile($url);
        // 得到浏览器输出
        $img = ob_get_contents();
        // 清除输出并关闭
        ob_end_clean();
        // 获取图片大小
        $size = strlen($img);
        // 操作文件形式将图片保存
        /*
        $fp2 = @fopen($filename,'a');
        fwrite($fp2,$img);
        fclose($fp2);
        echo $filename.'  create success';*/

        // file_Pu_content来实现
        $res = file_put_contents($filename, $img);
        if ($res) {
            return true;
        }
        return false;
    }


    public function help($id=12)
    {
        $info = model('ShopCatelog')->field('id,title,content')->where('id',$id)->find();
        return view('',['info'=>$info,'id'=>$id]);
    }

    public function search()
    {
        $key = input("keywords");
        if(!Db::name('ShopSearch')->where('keywords',$key)->find()){
            Db::name('ShopSearch')->insert(['keywords'=>$key,'create_time'=>date('Y-m-d H:i:s')]);
        }
        $pros = model('ShopProduct')
            ->alias('a')
            ->where('a.name','like',"%$key%")
            ->field('a.id,a.name,a.shop_price,b.path')
            ->join([['system_file b','a.posters = b.id','left']])
            ->paginate(12,false,[
                'type'     => 'bootstrap',
                'var_page' => 'page',
            ]);
        $page = $pros->render();
        $assign = compact('pros','page');
        return view('shop@product/cate',$assign);
    }
}