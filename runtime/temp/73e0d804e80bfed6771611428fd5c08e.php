<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/manager\view\login\login.html";i:1535871932;}*/ ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>后台登陆</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
    function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Meta tag Keywords -->

    <!-- css files -->
    <link rel="stylesheet" href="/static/css/admin-login.css" type="text/css" media="all" /> <!-- Style-CSS -->
    <link rel="stylesheet" href="/static/css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->

    <!-- js -->
    <script type="text/javascript" src="/static/js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="/static/vendor/layer/layer.js"></script>
    <script type="text/javascript" src="/static/system/core.js"></script>
    <!-- //js -->

    <!-- online-fonts -->
    <!--<link href="//fonts.googleapis.com/css?family=Oleo+Script:400,700&amp;subset=latin-ext" rel="stylesheet">
    --><!-- //online-fonts -->
</head>
<body>
<script src="/static/js/jquery.vide.min.js"></script>
<!-- main -->
<div data-vide-bg="/static/video/Ipad">
    <div class="center-container">
        <!--header-->
        <div class="header-w3l">
            <h1>商户后台管理系统</h1>
        </div>
        <!--//header-->
        <div class="main-content-agile">
            <div class="sub-main-w3">
                <div class="wthree-pro">
                    <h2>登录</h2>
                </div>
                <form action="#" method="post" id="loginForm">
                    <input placeholder="用户名或电子邮件" id="name" name="name" class="user" type="text" required="">
                    <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span><br><br>
                    <input  placeholder="Password" name="password" id="pass" class="pass" type="password" required="">
                    <span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
                    <div class="sub-w3l">
                        <h6 style="opacity: 0"><a href="#">忘记密码?</a></h6>
                        <div class="right-w3l">
                            <input type="button" id="goLogin" value="登录">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--//main-->

        <!--footer-->
        <div class="footer">
            <p>&copy; 2017 Classic Login Form. All rights reserved | Design by <a href="#">XXX</a></p>
        </div>
        <!--//footer-->
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#goLogin").click(function () {
            if(!$("#name").val() || !$("#pass").val()){
                layer.msg('请输入账号密码',{icon:5});
                return
            }
            var url = "<?php echo url('checkAuth'); ?>";
            var data = pbFormJson('loginForm');
            pbAjax($(this),url,data,function (res) {
                window.location.href = res.url;
            });
        });
    });
</script>
</body>
</html>