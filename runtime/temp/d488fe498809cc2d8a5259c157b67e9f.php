<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:87:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/shop\view\product\detail.html";i:1536327106;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\header.html";i:1536327106;s:73:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\nav.html";i:1536327106;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\footer.html";i:1535978470;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $cfg['site_name']; if(!empty($cur_title)): ?>_<?php echo $cur_title; endif; ?></title>
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
<link href="/static/shop/css/me_home.css" rel="stylesheet" type="text/css"/>
<link href="/static/shop/css/search.css" rel="stylesheet" type="text/css"/>
<link href="/static/shop/css/user.css" rel="stylesheet" type="text/css"/>
<link href="/static/shop/css/canshu.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/static/shop/canshu_js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/static/shop/canshu_js/jquery.jqzoom.js"></script>
<script type="text/javascript" src="/static/shop/canshu_js/base.js"></script>
<script src="/static/shop/js/tab.js"></script>

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
                <form action="<?php echo url('index/search'); ?>" method="get">
                    <input type="text" class="S-text fl" name="keywords" placeholder="请输入关键词搜索" style="color:#c4c4c4" />
                    <input type="submit" class="S-submit size14 fl" value="搜索">
                </form>
            </div>
            <!--热词-->
            <div class="hot-words">
                <?php foreach($his as $k=>$v): ?>
                <a href="<?php echo url('index/search',['keywords'=>$v['keywords']]); ?>"><?php echo $v['keywords']; ?></a>
                <?php endforeach; ?>
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
<!--位置-->
<div class="user_here center">所在的位置：首页 > 商品详情 > <?php echo $info['name']; ?></div>
<div class="ibody" style="margin-top:10px">
    <!--参数-->
    <div class="extraBox">
        <!--产品参数开始-->
        <div>
            <div id="preview" class="spec-preview">
                <div class="jqzoom"><img jqimg="<?php echo $info['path']; ?>" src="<?php echo $info['path']; ?>" width="350" height="350"/></div>
                <!--缩图开始-->
                <div class="spec-scroll">
                    <a class="prev">&lt;</a>
                    <a class="next">&gt;</a>
                    <div class="items">
                        <ul>
                            <li><img alt="<?php echo $info['name']; ?>" bimg="<?php echo $info['path']; ?>" src="<?php echo $info['path']; ?>"
                                     onmousemove="preview(this);"></li>
                        </ul>
                    </div>
                </div>
                <!--缩图结束-->
                <div class="scAndfx">
                    <div class="bdsharebuttonbox fl">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    </div>
                    <script>
                        window._bd_share_config = {
                            "common": {
                                "bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdPic": "", "bdStyle": "0", "bdSize": "16"
                            }, "share": {}
                        };
                        with (document) 0[(getElementsByTagName('head')[0] || body)
                            .appendChild(createElement('script'))
                            .src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                    </script>
                </div>

            </div>

            <div class="extra-text">
                <div class="extra-text-header">
                    <p class="size14-b color2"><?php echo $info['name']; ?></p>
                    <p class="size14-b color4">
                    </p>
                </div>
                <form action="">
                    <input type="hidden" name="product_id" value="<?php echo $info['id']; ?>">
                    <div class="extra-text-body">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="70" align="right">店内价格：</td>
                                <td><span class="size20 color4">￥<?php echo $info['shop_price']; ?></span>&nbsp;&nbsp;<a href="#"
                                                                                                         class="color5"></a>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">选择数量：</td>
                                <td>
                                    <div class="shuliang fl"><input type="text" name="number" value="1" min="1"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="buyBottonBox">
                        <a href="<?php if(!\think\Session::get('shopUser')): ?><?php echo url('open/login'); else: ?> javascript:void(0); <?php endif; ?>"
                           class="buyBotton-one fl shop-add-cart">加入购物车
                        </a>
                        <a href="<?php if(!\think\Session::get('shopUser')): ?><?php echo url('open/login'); else: ?> javascript:void(0); <?php endif; ?>"
                           class="buyBotton-two fl shop-buy-now">立即购买
                        </a>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div class="clear"></div>
    <!--评价/店铺-->
    <div class="evaluationBox center">
        <div class="evaluation-left fl">
            <div class="e-l-menu">
                <ul>
                    <li><a href="#" class="menub6_1" id="menu_6_1" onmouseover=showtabs6(6,1,5);>商品介绍</a></li>
                </ul>
            </div>
            <div class="e-l-text" id="menutab_6_1">
                <div style="padding:10px">
                    <?php echo $info['details']; ?>
                    <br />
                    <?php echo $info['configure']; ?>
                    <br />
                    <img src="<?php echo $info['path']; ?>" alt="">
                </div>

            </div>
        </div>
        <div class="evaluation-right fr">

            <div class="all-dp-box" style=" margin-top:0px;">
                <div class="all-dp-head">产品搜索</div>
                <div class="all-dp-body center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>关键字：</td>
                            <td><input type="text" name="textfield" class="dp-text gjz-text"/></td>
                        </tr>
                        <tr>
                            <td>价格：</td>
                            <td>
                                <input type="text" name="textfield" class="dp-text jg-text"/> - <input type="text"
                                                                                                       name="textfield"
                                                                                                       class="dp-text jg-text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="Submit" value="提交" class="dp-Submit"/></td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>
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
