<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/shop\view\open\login.html";i:1535978470;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登录</title>
    <!-- link css -->
    <link href="/static/shop/css/style.reset.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/css3style.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/font-color-size.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/table.select.style.css" rel="stylesheet" type="text/css" />
    <link href="/static/shop/css/login-style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- 顶部 -->
<div class="login-top center">
</div>

<!-- 登录 -->
<div class="login-body shadow center">

    <div class="clear center" style=" width:94% ; height:60px ; "><span style="display:none">此DIV起增高作用！</span></div>
    <div class="login-enter enterInput center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="67%" rowspan="5">
                    <div class="login-focus fr" style="border-right:1px dotted #ccc">
                        <img src="/static/shop/img/other/focus01.jpg" width="450" height="295" />
                    </div>
                </td>
                <td width="33%">
                    <input type="text" class="login-input-text  box-shadow fl" id="user" value="用户名/邮箱/手机" name="" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" class="login-input-text login-input-password box-shadow fl" id="mima" value="密码" name="" />
                </td>
            </tr>
            <tr>
                <td><a href="index.html"><p style="padding-top:15px ; _padding-top:5px"><button class="login-input-submit fl">登 录</button></p></a></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <div style="border-bottom:1px dotted #CCCCCC ; width:250px ; padding:7px 0 ; margin-bottom:7px">
                        <a href="<?php echo url('forget'); ?>">忘了密码？</a>&nbsp;&nbsp; | &nbsp;&nbsp;<a href="<?php echo url('register'); ?>">注册新帐号</a>&nbsp;&nbsp; </div>


                </td>
            </tr>
        </table>
    </div>
    <div class="clear center" style=" width:94% ; height:60px ; "><span style="display:none"></span></div>

</div>

<!-- 底部 -->
<div class="login-bottom center">
    <p>
        <?php echo $cfg['copy_right']; ?><br />
        <?php echo $cfg['address']; ?> 联系电话：<?php echo $cfg['contact']; ?><br />
        <?php echo $cfg['icp']; ?>
    </p>
</div>
</body>
</html>
