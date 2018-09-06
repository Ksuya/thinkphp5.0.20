<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\product\cate.html";i:1536138388;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\header.html";i:1536050763;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\nav.html";i:1536227597;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\footer.html";i:1535975239;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>首页</title>
    <link href="/static/shop/css/style.reset.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/font-color-size.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/table.select.style.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/top-style.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/index-body-style.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/css3style.css" rel="stylesheet" type="text/css" />
    <script src="/static/shop/js/top-city-check.js"></script>
    <script src="/static/system/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/shop/js/members.js"></script>
</head>
<link href="/static/shop/css/me_home.css" rel="stylesheet" type="text/css" />
<link href="/static/shop/css/search.css" rel="stylesheet" type="text/css" />
<body>
<!-- 顶部 -->
<div class="index-top-box">
    <div class="index-top center">
        <?php if(\think\Session::get('shopUserId')): ?>
        <!--我的订单-->
        <div class="fr noneAny"><a href="<?php echo url('open/logout'); ?>">安全退出</a></div>
        <div class="fr noneAny"><a href="<?php echo url('user/index'); ?>"><b style="color: orange">个人中心</b></a></div>
        <?php else: ?>
        <!--免费注册-->
        <div class="fr noneAny"><a href="<?php echo url('open/register'); ?>">[免费注册]</a></div>
        <!--登录-->
        <div class="fr noneAny"><a href="<?php echo url('open/login'); ?>">[登录]</a></div>
        <?php endif; ?>
        <div class="fr noneAny">亲，<b style="color: orange"><?php echo \think\Session::get('shopUser.nick_name'); ?></b> &nbsp;欢迎来<?php echo $cfg['site_name']; ?>！</div>
    </div>
</div>

<!-- 顶部结束-->
<div class="clear"></div>
<!-- logo开始-->
<div class="logoBox center">
    <!--左侧logo-->
    <div class="logo fl">
        <span class="fl"><a href="<?php echo url('/shop'); ?>"><img src="<?php echo (isset($cfg['site_logo_path']) && ($cfg['site_logo_path'] !== '')?$cfg['site_logo_path']:'/static/shop/img/login/logo.jpg'); ?>" style="width:200px;" /></a></span>
    </div>

    <!--右侧search-->
    <div class="searchBox fl">

        <!--搜索BOX-->
        <div class="searchinput fr">
            <!--搜索-->
            <div class="S-bg">
                <form action="<?php echo url('index/search'); ?>" method="post">
                    <input type="text" class="S-text fl" name="keywords" placeholder="请输入关键词搜索" style="color:#c4c4c4" />
                    <input type="button" class="S-submit size14 fl" value="搜索">
                </form>
            </div>
            <!--热词-->
            <div class="hot-words">

            </div>
        </div>

    </div>
</div>
<!-- logo结束-->
<div class="clear"></div>
<!-- 导航开始-->
<div class="navBox">
    <div class="nav center">
        <!--商品分类-->
        <div class="classification fl">
            <div class="hd size14-b">商品分类</div>
        </div>
        <!--导航栏目-->
        <div class="bigNav fl">
            <ul>
                <li><a href="<?php echo url('/shop'); ?>">商城首页</a></li>
                <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('product/cate',['id'=>$item['id']]); ?>"><?php echo $item['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <li><a href="<?php echo url('index/help',['id'=>51]); ?>">关于我们</a></li>
            </ul>
        </div>
        <?php if(\think\Session::get('shopUserId')): ?>
        <!--购物车-->
        <div class="shopping-cart fr size14">购物车 ( <a href="user.html">0</a> ) 件</div>
        <?php endif; ?>
    </div>
</div>
<!--导航结束-->
<div class="clear"></div>
<div class="user_here center">所在的位置：中国美博城 > 我的订单</div>
<div class="center results_of_search" style="margin-top: 40px;">

    <!--<div class="results_list fl s_one">
        <ul>
            <li><a href="#" class="checkOn">默认</a></li>
            <li>最新</li>
        </ul>
    </div>-->
   <!-- <div class="results_list fl s_two">
        <ul>
            <li>价格</li>
            <li><input name="" type="text"  value="￥" class="oto_text" /></li>
            <li style="width:18px"> - </li>
            <li><input name="" type="text"  value="￥" class="oto_text" /></li>
            <li>确定</li>
            <li>清空</li>
        </ul>
    </div>-->
</div>

<div class="ibody">
    <!--产品普通排列图-->
    <div class="shangpin_Box center">
        <ul>
            <?php foreach($pros as $k=>$v): ?>
            <li>
                <div class="padding10">
                    <p><img src="<?php echo $v['path']; ?>" width="200" height="200" /></p>
                    <p class="color4 size20">￥<?php echo $v['shop_price']; ?></p><?php echo $v['name']; ?></a></p>
                    <p class="btn_buy">
                        <button class="shangpin_Box_button2"><a href="<?php echo url('product/detail',['id'=>$v['id']]); ?>">立即购买</a></button>
                    </p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div style="text-align: center;">
       <?php echo $page; ?>
    </div>


    <div class="clear" style="height:30px"></div>

</div>

<div class="clear" style="height:30px"></div>

<div class="footerLink">
    <div class="footerLink_ul center">
        <?php if(is_array($catelog) || $catelog instanceof \think\Collection || $catelog instanceof \think\Paginator): $i = 0; $__LIST__ = $catelog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <ul>
            <h2><?php echo $item['title']; ?></h2>
            <?php if(!empty($item['subLog'])): if(is_array($item['subLog']) || $item['subLog'] instanceof \think\Collection || $item['subLog'] instanceof \think\Paginator): $i = 0; $__LIST__ = $item['subLog'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subitem): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('index/help',['id'=>$subitem['id']]); ?>"><?php echo $subitem['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<div class="footer center">
    <p>
        <?php echo (isset($cfg['copy_right']) && ($cfg['copy_right'] !== '')?$cfg['copy_right']:''); ?><br />
        <?php echo (isset($cfg['address']) && ($cfg['address'] !== '')?$cfg['address']:''); ?> 联系电话：<?php echo (isset($cfg['contact']) && ($cfg['contact'] !== '')?$cfg['contact']:''); ?><br />
        <?php echo (isset($cfg['icp']) && ($cfg['icp'] !== '')?$cfg['icp']:''); ?>
    </p>
</div>
</body>
</html>
