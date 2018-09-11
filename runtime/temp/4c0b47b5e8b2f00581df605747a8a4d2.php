<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:91:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\user\orderdetail.html";i:1536322191;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\header.html";i:1536321476;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\nav.html";i:1536296161;s:85:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\personal-left.html";i:1535975208;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\footer.html";i:1535975239;}*/ ?>
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
<link href="/static/shop/css/user.css" rel="stylesheet" type="text/css"/>
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
<div class="user_here center">所在的位置：中国美博城 > 我的订单</div>
<!--用户管理中心-->
<div class="user_center center">
    <!--左侧-->
<div class="user_left fl">
    <div class="user_head"><img src="/static/shop/img/user/user_head.gif" /></div>
    <div class="user_menu">
        <ul>
            <h2><img src="/static/shop/img/user/menu04.jpg" /><span class="" style="display:none">个人信息</span></h2>
            <li><a href="<?php echo url('user/index'); ?>">&gt;&gt;&nbsp;编辑资料</a></li>
        </ul>
        <ul>
            <h2><img src="/static/shop/img/user/menu03.jpg" /><span class="" style="display:none">账户信息</span></h2>
            <li><a href="<?php echo url('user/address'); ?>" >&gt;&gt;&nbsp;收货地址</a></li>
        </ul>

        <ul>
            <h2><img src="/static/shop/img/user/menu01.jpg" /><span class="" style="display:none">订单查询</span></h2>
            <li><a href="<?php echo url('user/carts'); ?>">&gt;&gt;&nbsp;我的购物车</a></li>
            <li><a href="<?php echo url('user/order'); ?>">&gt;&gt;&nbsp;我的订单</a></li>
        </ul>
        <ul>
            <h2><img src="/static/shop/img/user/menu02.jpg" /><span class="" style="display:none">自助服务</span></h2>
            <li><a href="<?php echo url('index/help'); ?>">&gt;&gt;&nbsp;帮助中心</a></li>
        </ul>
    </div>
</div>
    <!--右侧-->
    <!--右侧-->
    <div class="user_right fr">
        <div class="user_dingdan">
            <span class="fr"><a href="#"></a></span>
            <p>订单详情</p>
        </div>

        <div class="shopping_list_2" style="border-top:none;">
            <table width="100%" border="0" class="shopping_list_table1" cellspacing="0" cellpadding="0">

                <tr class="goodsbg">
                    <td height="60" colspan="8" valign="top" style="border:1px solid #ff6600; background:#fff4d3;">


                        <div class="fuxuan_2" style="padding:10px 0px;">
                            <strong style="line-height:40px;">当前订单状态： <?php echo $order['status']['name']; ?>;
                                物流状态:<?php echo $order['progress']['name']; ?></strong>
                            <?php if($order['progress']['id'] == 2): ?>
                            <p>
                                <span class="fl">1.如果您已收到货，且对商品满意，您可以&nbsp;  </span>
                                <a href="#" class="fl"
                                   style="width:60px; height:20px; text-align:center; line-height:20px; background:#ff6600; display:block; color:#ffffff;">
                                    确认收货
                                </a>
                            </p><br/>
                            <p style=" margin-top:5px;"> 2.如果还未收到货，，您可以 <a href="#" style="color:#3699dc">查询物流状态</a></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php if($order['progress']['id'] > 1): ?>
                <tr>
                    <td height="50" colspan="2" style="border-bottom:1px solid #dedede;">
                        <strong style="color:#000000; font-size:14px;">物流信息</strong>
                    </td>
                </tr>
                <tr>
                    <td height="30" colspan="2">物流公司：<?php echo $order['express_id']['name']; ?> </td>
                    <td height="30" colspan="2">运单号码：<?php echo $order['express_code']; ?> </td>
                </tr>
                <tr>
                    <?php foreach($order['route'] as $k=>$v): ?>
                    <td height="30" colspan="2" style="color:#ff6600">
                        物流跟踪：<?php echo $v['time']; ?> <?php echo $v['context']; ?>
                        <br />
                    </td>
                    <br />
                    <?php endforeach; ?>
                </tr>
                <?php endif; ?>
            </table>


            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#666666" class="table_xiangxi">
                <tr>
                    <td width="10%" height="35" align="right" style="padding-top:10px;"><strong>收货地址：</strong></td>
                    <td height="35" colspan="3" style="padding-top:10px;"> <?php echo $order['reciver']; ?> ，<?php echo $order['contact']; ?>
                        ，<?php echo $order['region']; ?> <?php echo $order['address']; ?>
                    </td>
                </tr>


                <tr>
                    <td width="10%" height="35" align="right" style="padding-top:10px;"><strong>订单信息：</strong></td>
                    <td height="35" colspan="3" style="padding-top:10px;">  编号：<?php echo $order['order_no']; ?>
                    </td>
                </tr>

                <tr>
                    <td height="35" align="right">&nbsp;</td>
                    <td height="35" colspan="2">发货时间：<?php echo $order['update_time']; ?></td>
                    <td height="35">下单时间：<?php echo $order['create_time']; ?></td>
                </tr>
            </table>


            <table width="100%" cellspacing="0" cellpadding="0" class="goumai_sp"
                   style="text-align:center; margin-top:10px;">
                <tr>
                    <td width="480">商品</td>
                    <td width="100">商品价</td>
                    <td width="100">市场价</td>
                    <td width="100">数量</td>
                </tr>

            </table>


            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center; margin-top:5px; padding-bottom:5px;   ">
                <?php foreach($order['products'] as $k=>$v): ?>
                <tr>
                    <td width="504" style="text-align:left;"><a href="#" target='_blank'
                                                                style="float:left; margin:0 10px;">
                        <img alt="" src="<?php echo $v['path']; ?>" width="50px" height="50px" style="border:1px solid #dcdcdc"></a>
                        <div class="p-detail">
                            <div class="p-name">
                                <a href="#">
                                    <?php echo $v['name']; ?>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td width="114"><?php echo $v['shop_price']; ?>元</td>
                    <td width="114"><?php echo $v['market_price']; ?></td>
                    <td width="114"><?php echo $v['number']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>


        </div>
        <div class="zongji">
            <p>
					<span class="fr">订单总额<span class="color4 size18"> ￥<?php echo $order['order_amount']; ?> </span>元
					   </span>

            </p>
        </div>

    </div>
</div>

</div>
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
</html>
