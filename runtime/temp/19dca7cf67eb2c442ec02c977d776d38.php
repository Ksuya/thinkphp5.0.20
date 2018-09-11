<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/blog\view\index\index.html";i:1536327106;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\blog\view\public\header.html";i:1536327106;s:73:"D:\phpStudy\PHPTutorial\WWW\payment\application\blog\view\public\nav.html";i:1536327106;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\blog\view\public\footer.html";i:1535871932;}*/ ?>
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
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid ">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo url('/blog'); ?>">whlphper-博客</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <?php foreach($nav as $k=>$v): if(!empty($v['subNav'])): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php echo $v['name']; ?>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach($v['subNav'] as $k2=>$v2): ?>
                                    <li><a href="#"><?php echo $v2['name']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li><a href="#"><?php echo $v['name']; ?></a></li>
                        <?php endif; endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div id="myCarousel" class="col-sm-12 carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="https://www.runoob.com/wp-content/uploads/2014/07/E39F20EC-9F9F-4BEC-9B8C-ADD5C99E9EEA.png"
                         alt="First slide">
                    <div class="carousel-caption">标题 1</div>
                </div>
                <div class="item">
                    <img src="https://www.runoob.com/wp-content/uploads/2014/07/E39F20EC-9F9F-4BEC-9B8C-ADD5C99E9EEA.png"
                         alt="Second slide">
                    <div class="carousel-caption">标题 2</div>
                </div>
                <div class="item">
                    <img src="https://www.runoob.com/wp-content/uploads/2014/07/E39F20EC-9F9F-4BEC-9B8C-ADD5C99E9EEA.png"
                         alt="Third slide">
                    <div class="carousel-caption">标题 3</div>
                </div>
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <ul class="r_box">
                <?php foreach($list as $K=>$v): ?>
                <li style="cursor: pointer"><i><a href="<?php echo url('/blog/article/info',['id'=>$v['id']]); ?>" title="<?php echo $v['title']; ?>"><img
                        src="http://www.yangqq.com/d/file/blogs/2018-06-18/0daedba8782d1b87dd38d9914d9cee3f.png"
                        alt="<?php echo $v['title']; ?>？"></a></i>
                    <h3>[ 顶 ] <a href="<?php echo url('/blog/article/info',['id'=>$v['id']]); ?>"><?php echo $v['title']; ?></a></h3>
                    <p><?php echo $v['description']; ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <!--<ul class="pagination pagination-lg" style="float: right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>-->
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