<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:85:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/shop\view\user\index.html";i:1536125119;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\header.html";i:1536050763;s:75:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\nav.html";i:1536296161;s:85:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\personal-left.html";i:1535975208;s:78:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\shop\view\public\footer.html";i:1535975239;}*/ ?>
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
    <div class="user_right fr">
        <div class="user_dingdan">
            <p>编辑资料</p>
        </div>
        <div class="fapiao_table ziliao_table">
            <form action="<?php echo url('saveInfo'); ?>">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="80" class="color2" align="right">昵称</td>
                        <td><input type="text" class="oto_text_one oto_text_two fl" name="nick_name" value="<?php echo $info['nick_name']; ?>"/>
                            <span class="fl margin10 lineheight30">长度不能超过12字</span></td>
                    </tr>
                    <tr>
                        <td width="80" align="right" class="color2"><span class="color4 size14">*</span> 邮箱</td>
                        <td><input type="text" class="oto_text_one fl" value="<?php echo $info['email']; ?>" readonly />
                            <span class="fl margin10 lineheight30"></span></td>
                    </tr>
                    <tr>
                        <td width="80" align="right" class="color2"><span class="color4 size14">*</span>手机号</td>
                        <td><input type="text" class="oto_text_one oto_text_two fl" value="<?php echo $info['phone']; ?>" readonly /></td>
                    </tr>
                    <tr>
                        <td width="80" align="right" class="color2">真实姓名</td>
                        <td><input type="text" class="oto_text_one oto_text_two fl" name="real_name" value="<?php echo $info['real_name']; ?>"/></td>
                    </tr>
                    <tr>
                        <td width="80" align="right" class="color2">身份证号码</td>
                        <td><input type="text" class="oto_text_one fl" name="id_card" value="<?php echo $info['id_card']; ?>"/></td>
                    </tr>
                    <tr>
                        <td width="80" align="right" valign="top" class="color2"><span class="color4 size14">*</span>所在地</td>
                        <td>
                            <div class="cxselect-list" style="width:100% ; height:35px" id="company_region">
                                <select class="oto_select add_sheng fl province" name="region" data-first-title="选择省" data-value="<?php echo $info['region']['0']; ?>">
                                </select>
                                <select class="oto_select add_shi fl city" name="region" data-first-title="选择市" data-value="<?php echo $info['region']['1']; ?>">
                                </select>
                                <select class="oto_select add_qu fl area" name="region" data-first-title="选择区" data-value="<?php echo $info['region']['2']; ?>">
                                </select>
                            </div>
                            <div class="" style="width:100% ; height:35px">
                                <input type="text" class="oto_text_one fl" name="address" value="<?php echo $info['address']; ?>"
                                       style="width:360px"/>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <button class="btn_baocun shop-submit" type="button">保存修改</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script src="/static/vendor/cxselect/jquery.cxselect.min.js"></script>
<script>
    $(function () {
        // 全国省市区
        $('#company_region').cxSelect({
            selects: ['province', 'city', 'area'],
            nodata: 'none',
            url: '/static/vendor/cxselect/cityData.min.json',
        });
    });
</script>
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
