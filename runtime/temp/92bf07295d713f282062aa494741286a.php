<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\index\index.html";i:1536138478;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\header.html";i:1536050763;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\nav.html";i:1536137533;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\footer.html";i:1535975239;}*/ ?>
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
        <span class="fl"><img src="<?php echo (isset($cfg['site_log']) && ($cfg['site_log'] !== '')?$cfg['site_log']:'/static/shop/img/login/logo.jpg'); ?>" /></span>
    </div>

    <!--右侧search-->
    <div class="searchBox fl">

        <!--搜索BOX-->
        <div class="searchinput fr">
            <!--搜索-->
            <div class="S-bg">
                <form action="<?php echo url('index/search'); ?>" method="post">
                    <input type="text" class="S-text fl" name="keywords" placeholder="请输入关键词搜索" style="color:#c4c4c4" />
                    <a href=""><input type="submit" class="S-submit size14 fl" value="搜索"></a>
                </form>
            </div>
            <!--热词-->
            <div class="hot-words">
                <a href="allsearch.html">潮流男装</a>
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
<!--banner 开始-->
<div class="slideBox center">
    <script language="javascript" src="/static/shop/js/common.js"></script>
    <script language="javascript" src="/static/shop/js/nav.js"></script>
    <div class="menuNav">
        <h2></h2>
        <div class="navlist" id="SNmenuNav" >
            <?php foreach($allNav as $k=>$v): ?>
            <dl>
                <dt class="icon03" ><a href="<?php echo url('product/cate',['id'=>$v['id']]); ?>"><?php echo $v['name']; ?> </a></dt>
                <?php if(!empty($v['subNav'])): ?>
                <dd class="menv<?php echo $k; ?>">
                    <div class="menv0<?php echo $k; ?>_left">
                        <ul>
                            <?php foreach($v['subNav'] as $k2=>$v2): ?>
                            <li><a href="<?php echo url('product/cate',['id'=>$v['id']]); ?>" title="<?php echo $v2['name']; ?>"><h3 style="color:#d51938; float:left;"><?php echo $v2['name']; ?></h3></a>
                                <br />
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </dd>
                <?php endif; ?>
            </dl>
            <?php endforeach; ?>
        </div>
    </div>
    <!--幻灯片-->
    <script type="text/javascript" src="/static/shop/js/jquery.pack.js"></script>
    <script type="text/javascript" src="/static/shop/js/jquery.SuperSlide.js"></script>
    <div class="index_slide fr">
        <div class="hd">
            <ul>
                <?php foreach($banner as $k=>$v): ?>
                <li><?php echo $k+1; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="bd">
            <ul>
                <?php foreach($banner as $k=>$v): ?>
                <li><img title="<?php echo $v['name']; ?>" src="<?php echo $v['path']; ?>" width="980" height="420" /></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--商城公告-->
        <div class="index-notice" style="display: none;">
            <div class="notice-title">&nbsp;&nbsp;商城公告</div>
            <div class="notice-news center">
                <ul>
                    <li><a href="#"><img src="/static/shop/img/other/14.gif" /> </a><a href="#"  ><img src="/static/shop/img/other/12.jpg" /> </a></li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">jQuery(".index_slide").slide( { mainCell:".bd ul",effect:"top",autoPlay:true} );</script>
</div>

<!--爆品疯抢-->
<script src="/static/shop/js/tab.js"></script>

<?php foreach($showNav as $k=>$v): ?>
<div class="Version-world center">
    <div class="VersionBox fl" style="width: 100%">
        <div class="Version-hd">
            <div class="fl here-hd" style=""><?php echo $k+1; ?>F</div><div class="fl size16-b color2">&nbsp;<?php echo $v['name']; ?></div>
            <div class="fl" style="padding-left:100px;"></div>
        </div>
        <div class="Version-bd" style="width: 100%;">
            <div class="fl Version-bd-left">
                <dl class="Version-bd-left-text center">
                    <?php foreach($v['childs'] as $k2=>$v2): ?>
                    <dd><a href="<?php echo url('product/cate',['id'=>$v2['id']]); ?>"><?php echo $v2['name']; ?></a></dd>
                    <?php endforeach; ?>
                </dl>
                <div class="Version-bd-focus">
                    <a ><img src="<?php echo $v['path']; ?>" width="190" height="295" /></a>
                </div>
            </div>
            <div class="Version-bd-pro">
                <ul>
                    <?php foreach($v['products'] as $k2=>$v2): ?>
                    <li>
                        <div align="center" style="padding-top:10px;">
                            <a href="<?php echo url('product/detail',['id'=>$v2['id']]); ?>" title="<?php echo $v2['name']; ?>"><img src="<?php echo $v2['path']; ?>" width="150" height="150" /></a>
                        </div>
                        <div class="Version-bd-pro-text">
                            <p class="hd"><a href="<?php echo url('product/detail',['id'=>$v2['id']]); ?>" title="<?php echo $v2['name']; ?>"><?php echo $v2['name']; ?></a></p>
                            <p>价格：<span class="color4 size14">￥<?php echo $v2['shop_price']; ?></span></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

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
