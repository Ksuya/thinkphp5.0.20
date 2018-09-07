<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\index\index.html";i:1536234072;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1536223691;s:87:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-top-nav.html";i:1536320227;s:89:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-left-menu.html";i:1536228107;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-script.html";i:1534835935;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
    <script src="/static/js/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/js/tipSuppliers.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/system/vendor.js"></script>
    <script>
        $(document).ready(function () {
            $("#apitoken").val("<?php echo $api_token; ?>");
        });
    </script>
</head>
<body>
<input type="hidden" id="apitoken" value="">

<div class="top-header">
    <div class="logo" data-url="<?php echo url('Index/welcome'); ?>">
        <a href="#"><img src="/static/images/logo.png" class="img-responsive" /></a>
    </div>
    <div class="top-nav">
    <ul class="clearfix">
        <li>
            <i class="fa fa-file-text font_lager"></i>
            <p data-id="shop-manager">商城管理</p>
        </li>
        <!--
        <li>
            <i class="fa fa-file-text font_lager"></i>
            <p data-id="blog-manager">文章管理</p>
        </li>
        <li>
            <i class="fa fa-user-circle-o font_lager"></i>
            <p data-id="payment-manager">PAY管理</p>
        </li>-->
    </ul>
</div>
    <div class="top-nav_roll f_left" style="display:none;">
        <div class="f_left">
            <i class="fa fa-caret-left fa-1x"></i>
        </div>
        <div class="f_right">
            <i class="fa fa-caret-right fa-1x"></i>
        </div>
    </div>
    <ul class="login_msg">
        <li title="<?php echo \think\Session::get('merchatInfo.username'); ?>"></li>
        <li><a href="#" class="logout">退出</a></li>
    </ul>
</div>
<!--top end-->
<div class="main_left" >
    <h2><i class="menu_icon fa fa-reorder"></i></h2>
    <ul class="left-menu">
        <!--shop-->
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/banner'); ?>">首页轮播</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/category'); ?>">分类管理</a>
        </li>
        <!--<li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/Blog/category'); ?>">品牌管理</a>
        </li>-->
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/product'); ?>">商品管理</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/order'); ?>">订单管理</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/member'); ?>">用户管理</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/help'); ?>">帮助中心</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="shop-manager" data-href="<?php echo url('/manager/shop/config'); ?>">商城配置</a>
        </li>
        <!--shop-->

        <!--payment-->
        <li>
            <i class="menu_icon fa fa-commenting-o"></i>
            <a href="javascript:void(0);" data-id="payment-manager" data-href="<?php echo url('/manager/Merchat/Account/info'); ?>">账户信息</a>
        </li>
        <li>
            <i class="menu_icon fa fa-commenting-o"></i>
            <a href="javascript:void(0);" data-id="payment-manager" data-href="<?php echo url('/manager/Merchat/Account/withdraw'); ?>">提现记录</a>
        </li>
        <li>
            <i class="menu_icon fa fa-list"></i>
            <a href="javascript:void(0);" data-id="payment-manager" data-href="<?php echo url('/manager/Merchat/Security/index'); ?>">安全设置</a>
        </li>
        <li>
            <i class="menu_icon fa fa-file-text-o"></i>
            <a href="javascript:void(0);" data-id="payment-manager" data-href="<?php echo url('/manager/Merchat/Order/index'); ?>">订单查询</a>
        </li>
        <!--payment-->
        <!--blogb-->
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="blog-manager" data-href="<?php echo url('/manager/blog/category'); ?>">栏目管理</a>
        </li>
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="blog-manager" data-href="<?php echo url('/manager/blog/article'); ?>">文章管理</a>
        </li>
        <!--blogb-->
    </ul>
</div>
<!--left end-->
<div class="main_right">
    <iframe src="<?php echo url('welcome'); ?>" name="cont_box" style="float: left;" frameborder="0" width="100%" height="100%" seamless></iframe>
</div>
<!--desktop end-->
<!--javascript include-->


</body>
</html>