<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/blog\view\index\detail.html";i:1535622057;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\blog\view\public\header.html";i:1535621987;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\blog\view\public\nav.html";i:1535622009;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\blog\view\public\footer.html";i:1535621950;}*/ ?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>详情页</title>
    <link rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/css/blog.css">
    <script src="/static/system/jquery.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid ">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">菜鸟教程</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">iOS</a></li>
                    <li><a href="#">SVN</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Java
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">jmeter</a></li>
                            <li><a href="#">EJB</a></li>
                            <li><a href="#">Jasper Report</a></li>
                            <li class="divider"></li>
                            <li><a href="#">分离的链接</a></li>
                            <li class="divider"></li>
                            <li><a href="#">另一个分离的链接</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="page-header">
        <h1>页面标题实例
            <small>
                简介
                <span class="label label-default">默认标签</span>
                <span class="label label-default">默认标签</span>
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">

                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <h2>标签</h2>
            <h5>标签介绍:</h5>
            <div class="fakeimg">
                <span class="label label-default">默认标签</span>
                <span class="label label-primary">主要标签</span>
                <span class="label label-success">成功标签</span>
                <span class="label label-info">信息标签</span>
                <span class="label label-warning">警告标签</span>
                <span class="label label-danger">危险标签</span>
            </div>
            <h3>友情链接</h3>
            <p>友情链接描述文本。</p>
            <ul class="nav nav-stacked">
                <li class="active"><a href="#">链接 1</a></li>
                <li><a href="#">链接 2</a></li>
                <li><a href="#">链接 3</a></li>
            </ul>
            <hr class="hidden-sm hidden-md hidden-lg">
        </div>

    </div>
</div>
<footer>
    <p>Design by <a href="/tuseday/">whlphper 个人技术博客</a> 备案号：<a href="/">-1</a></p>
</footer>
</body>
</html>