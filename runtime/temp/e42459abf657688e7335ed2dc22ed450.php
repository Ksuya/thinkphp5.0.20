<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:98:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\public/../application/merchat\view\index\index.html";i:1534670558;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-header.html";i:1534855457;s:96:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-top-nav.html";i:1534656832;s:98:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-left-menu.html";i:1534770658;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-script.html";i:1534855457;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/static/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/vendor/icheck/skins/flat/green.css">
    <link rel="stylesheet" href="/static/vendor/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/static/vendor/select/css/bootstrap-select.min.css">
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
    <script src="/static/js/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
    <script src="/static/vendor/bootstrap-validate/js/language/zh_CN.js"></script>
    <script src="/static/vendor/cxselect/jquery.cxselect.min.js"></script>
    <script src="/static/vendor/icheck/icheck.min.js"></script>
    <script type="text/javascript" src="/static/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/static/vendor/select/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/static/vendor/datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
    <script src="/static/js/tipSuppliers.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/system/vendor.js"></script>
</head>
<body>

<div class="top-header">
    <div class="logo" data-url="<?php echo url('Index/welcome'); ?>">
        <a href="#"><img src="/static/images/logo.png"/></a>
    </div>
    <div class="top-nav">
    <ul class="clearfix">
        <li>
            <i class="fa fa-user-circle-o font_lager"></i>
            <p data-id="merchat">账户管理</p>
        </li>
        <li>
            <i class="fa fa-user-plus font_lager"></i>
            <p data-id="security">安全设置</p>
        </li>
        <li>
            <i class="fa fa-file-text font_lager"></i>
            <p data-id="order">订单信息</p>
        </li>
        <li>
            <i class="fa fa-users font_lager"></i>
            <p data-id="product">产品信息</p>
        </li>
        <li>
            <i class="fa fa-users font_lager"></i>
            <p data-id="checkout">结算信息</p>
        </li>

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
<div class="main_left">
    <h2><i class="menu_icon fa fa-reorder"></i></h2>
    <ul class="left-menu">
        <!--账户管理-->
        <li>
            <i class="menu_icon fa fa-commenting-o"></i>
            <a href="javascript:void(0);" data-id="merchat" data-href="<?php echo url('/merchat/Account/info'); ?>">账户信息</a>
        </li>
        <li>
            <i class="menu_icon fa fa-commenting-o"></i>
            <a href="javascript:void(0);" data-id="merchat" data-href="<?php echo url('/merchat/Account/withdraw'); ?>">提现记录</a>
        </li>
        <!--安全设置-->
        <li>
            <i class="menu_icon fa fa-list"></i>
            <a href="javascript:void(0);" data-id="security" data-href="<?php echo url('/merchat/Security/index'); ?>">安全设置</a>
        </li>

        <!--订单信息-->
        <li>
            <i class="menu_icon fa fa-file-text-o"></i>
            <a href="javascript:void(0);" data-id="order" data-href="<?php echo url('/merchat/Order/index'); ?>">订单信息</a>
        </li>
        <!--产品信息-->
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="product" data-href="<?php echo url('/merchat/Product/index'); ?>">产品信息</a>
        </li>

        <!--结算信息-->
        <li>
            <i class="menu_icon fa fa-users"></i>
            <a href="javascript:void(0);" data-id="checkout" data-href="<?php echo url('/mechat/Checkout/index'); ?>">结算信息</a>
        </li>


    </ul>
</div>
<!--left end-->
<div class="main_right">
    <iframe src="<?php echo url('welcome'); ?>" name="cont_box" frameborder="0" width="100%" height="100%" seamless></iframe>
</div>
<!--desktop end-->
<!--javascript include-->


</body>
</html>