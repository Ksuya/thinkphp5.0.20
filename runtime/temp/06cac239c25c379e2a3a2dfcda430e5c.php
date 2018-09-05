<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\pay\check.html";i:1536129875;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\header.html";i:1536050763;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\nav.html";i:1536041537;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\footer.html";i:1535975239;}*/ ?>
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
                <li><a href="<?php echo url('index/about'); ?>">关于我们</a></li>
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

    <!--右侧-->
    <div class="user_right" style="width: 100%">
        <div class="user_dingdan">
            <span class="fr"><a href="#">订单回收站</a></span><p>我的订单</p>
        </div>
        <div class="dingdan_state" style="width: 100%">
            <div class="state_step_2 fl"><p class="step-lv_2">1</p><p>1.选购商品</p></div>
            <div class="state_step_2 fl"><p class="step-lv">2</p><p>2.填写核对订单信息</p></div>
            <div class="state_step_hui_2 fl"><p class="step-hui">3</p><p>3.成功提交订单</p></div>
        </div>

        <div class="shopping_list_2" style="width: 100%">
            <table border="0" class="shopping_list_table" cellspacing="0" cellpadding="0" style="margin-top: 30px;">
                <tr>
                    <td colspan="7" class="table_manu_2"><h1 style="text-align:left;">填写收货信息</h1></td>
                </tr>
                <tr class="goodsbg address-select">
                    <?php foreach($address as $k=>$v): ?>
                    <td <?php if($v['is_default'] == 1): ?> class="cursel" <?php endif; ?> colspan="7" valign="top" data-id="<?php echo $v['id']; ?>">
                        <div class="fuxuan_2">
                            <strong><?php echo $v['reciver']; ?></strong>
                            <a href="#"><?php if($v['is_default']['id'] == 1): ?>[默认地址]<?php else: endif; ?></a>
                            <p><?php echo $v['contact']; ?><br />
                               <?php echo implode(',',$v['region']); ?>&nbsp;   <?php echo $v['address']; ?></p>
                        </div>
                    </td>
                    <?php endforeach; ?>
                </tr>

            </table>
            <table border="0" class="shopping_list_table" cellspacing="0" cellpadding="0" style="margin-top: 30px;">
                <tr>
                    <td colspan="7" class="table_manu_2"><h1 style="text-align:left;">选择支付方式</h1></td>
                </tr>
                <tr class="goodsbg paytype-select">
                    <td class="cursel" colspan="7" valign="top" data-id="1">
                        <div class="fuxuan_2">
                            <strong>支付宝支付</strong>
                        </div>
                    </td>
                    <td colspan="7" valign="top"  data-id="2">
                        <div class="fuxuan_2">
                            <strong>微信支付</strong>
                        </div>
                    </td>
                </tr>

            </table>

           <table width="100%"   cellspacing="0" cellpadding="0" class="goumai_sp" style="text-align:center; margin-top:30px;">

                <tr  >
                    <td width="480"  >商品</td>
                    <td width="100"  >商品价</td>
                    <td width="100" >市场价</td>
                    <td width="100"  >优惠</td>
                    <td width="100" style="border-right:0px"  >数量</td>
                </tr>
            </table>



            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center; margin-top:5px; padding-bottom:5px;"  >
                <?php foreach($details as $k=>$v): ?>
                <tr>
                    <td width="504" style="text-align:left;"> <a href="<?php echo url('product/detail',['id'=>$v['product_id']]); ?>" target='_blank' style="float:left; margin:0 10px;"><img alt="" src="<?php echo $v['path']; ?>" width="50px" height="50px" style="border:1px solid #dcdcdc"></a>  <div class="p-detail">
                        <div class="p-name">
                            <a href="<?php echo url('product/detail',['id'=>$v['product_id']]); ?>" target='_blank'>
                                <?php echo $v['name']; ?>
                            </a>
                        </div>
                        <div class="p-more">
                        </div>
                    </div></td>
                    <td width="114"><?php echo $v['shop_price']; ?>元</td>
                    <td width="114"><?php echo $v['market_price']; ?>元</td>
                    <td width="114"><?php echo $v['market_price']-$v['shop_price']; ?>元</td>
                    <td width="114"><?php echo $v['number']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>






        </div>
        <div class="zongji">
            <p>
					<span class="fr">应付金额<span class="color4 size18"> ￥<?php echo $order['order_amount']; ?> </span>元
					   </span>

            </p>
        </div>
        <div class="jiesuan">

            <button class="btn-js fr shop-checkout" data-order="<?php echo $order['id']; ?>">去结算</button>
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
