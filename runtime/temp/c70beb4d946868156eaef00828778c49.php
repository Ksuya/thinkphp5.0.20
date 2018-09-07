<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\open\forget.html";i:1536227445;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>登录</title>
    <!-- link css -->
    <link href="/static/shop/css/style.reset.css" rel="stylesheet" type="text/css"/>
    <link href="/static/shop/css/css3style.css" rel="stylesheet" type="text/css"/>
    <link href="/static/shop/css/font-color-size.css" rel="stylesheet" type="text/css"/>
    <link href="/static/shop/css/table.select.style.css" rel="stylesheet" type="text/css"/>
    <link href="/static/shop/css/login-style.css" rel="stylesheet" type="text/css"/>
    <link href="/static/shop/css/top-style.css" rel="stylesheet" type="text/css"/>
    <script src="/static/system/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/shop/js/members.js"></script>
    <script>
        $(document).ready(function () {
            $("#apitoken").val("<?php echo $api_token; ?>");
        });
    </script>
</head>

<body>
<!-- 顶部 -->
<div class="login-top center">
    <!--左侧logo-->
    <div class="logo fl">
        <span class="fl"><a href="<?php echo url('/shop'); ?>"><img src="<?php echo (isset($cfg['site_logo_path']) && ($cfg['site_logo_path'] !== '')?$cfg['site_logo_path']:'/static/shop/img/login/logo.jpg'); ?>" style="width:200px;" /></a></span>
    </div>

</div>


<!-- 找回密码 -->
<div class="login-body shadow center">

    <div class="clear center" style=" width:94% ; height:auto ; padding-top:20px; "><span style="display:none"></span>
        <div class="find-title">
            <a href="#" id="current">绑定邮箱找回</a>
        </div>
    </div>
    <div class="login-enter zhuceInput center">
        <form action="<?php echo url('modify'); ?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="2%" rowspan="4">&nbsp;</td>
                    <td width="62%">
                        <div>输入邮箱</div>
                        <input type="email" class="login-input-text input-long  box-shadow" id="email" value="" name="email"/>
                    </td>
                    <td width="5%" rowspan="4" style="border-left:1px dotted #ccc">&nbsp;</td>
                    <td width="31%" rowspan="4" valign="top">
                        <div>
                            <p>已有美博城账号？</p>
                            <p><a href="<?php echo url('login'); ?>" class="btn-enter css3bg border-radius"> 现在登录 </a></p>
                        </div>
                        <div style="border-top:1px dotted #ccc ; margin-top:40px; padding-bottom:30px; _padding-bottom:10px; width:80%"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>设置新密码</div>
                        <input type="password" class="login-input-text login-input-password input-long box-shadow"
                               value="" name="password"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>输入验证码</div>
                        <input type="password" class="login-input-text box-shadow validation fl" placeholder="点击获取验证码,在邮箱获取" value="" name="code"
                               style=" width:170px"/>
                        <button class="send border-radius fl getEmailCode" type="button">免费获取验证码</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="padding-top:5px ; _padding-top:5px">
                            <button class="login-input-submit fl shop-submit" type="button">确 认</button>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="clear center" style=" width:94% ; height:50px ; "><span style="display:none">此DIV起增高作用！</span></div>

</div>
<!-- 底部 -->
<div class="login-bottom center">
    <p>
        <?php echo $cfg['copy_right']; ?><br/>
        <?php echo $cfg['address']; ?> 联系电话：<?php echo $cfg['contact']; ?><br/>
        <?php echo $cfg['icp']; ?>
    </p>
</div>
</body>
</html>
