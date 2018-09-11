<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/index\view\index\index.html";i:1536329506;}*/ ?>

<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>whlphper-博客</title>
    <link rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/css/blog.css">
    <script src="/static/system/jquery.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
   <button id="pay">支付</button>
</div>
<script>
    $("#pay").click(function () {
        var url = "<?php echo url('pay'); ?>";
        $.post(url,{},function (res) {
            console.log(res)
        });
    });
</script>
</body>
</html>