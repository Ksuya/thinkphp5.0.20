<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:83:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/shop\view\user\index.html";i:1535978470;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\header.html";i:1535978470;s:73:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\nav.html";i:1535978470;s:83:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\personal-left.html";i:1535978470;s:76:"D:\phpStudy\PHPTutorial\WWW\payment\application\shop\view\public\footer.html";i:1535978470;}*/ ?>
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
</head>
<link href="/static/shop/css/user.css" rel="stylesheet" type="text/css" />
<body>
<!-- 顶部 -->
<div class="index-top-box">
    <div class="index-top center">
        <?php if(\think\Session::get('shopUserId')): ?>
        <!--我的订单-->
        <?php else: ?>

        <div class="fr noneAny"><a href="<?php echo url('user/index'); ?>">个人中心</a></div>
        <!--免费注册-->
        <div class="fr noneAny"><a href="<?php echo url('open/login'); ?>">[免费注册]</a></div>
        <!--登录-->
        <div class="fr noneAny"><a href="<?php echo url('open/register'); ?>">[登录]</a></div>
        <?php endif; ?>
        <div class="fr noneAny">亲，欢迎来<?php echo $cfg['site_name']; ?>！</div>
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
<div class="user_here center">所在的位置：中国美博城 > 编辑资料</div>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>

                    <td width="147" rowspan="9" align="center" class="color2" valign="top">
                        <p><img src="/static/shop/img/user/touxiang.gif" width="105" height="105" /></p>
                        <p><a href="#">修改头像</a></p></td>
                    <td width="80" align="right" class="color2">用户名</td>
                    <td width="733"><strong>otochina@163.com</strong></td>
                </tr>
                <tr>
                    <td width="80" class="color2" align="right">昵称</td>
                    <td><input type="text" class="oto_text_one oto_text_two fl" name="textfield" value="小刘" />
                        <span class="fl margin10 lineheight30">长度不能超过4字</span></td>
                </tr>
                <tr>
                    <td width="80" align="right" class="color2"><span class="color4 size14">*</span> 邮箱</td>
                    <td><input type="text" class="oto_text_one fl" name="textfield" />
                        <span class="fl margin10 lineheight30"><a class="color5" href="#">[修改]</a></span></td>
                </tr>
                <tr>
                    <td width="80" align="right" class="color2"><span class="color4 size14">*</span> 手机</td>
                    <td>
                        <span class="fl lineheight30">绑定手机，让账户更安全</span>
                        <span class="fl lineheight30 margin10"><button class="btn_baocun">验证手机</button></span>						</td>
                </tr>
                <tr>
                    <td width="80" align="right" class="color2"><span class="color4 size14">*</span> 性别</td>
                    <td>
                        <label><input name="" type="radio" value="保密" class="fl" style=" margin:4px" /> <span class="fl">保密</span></label>
                        <label><input name="" type="radio" value="男" class="fl" style=" margin:4px ; margin-left:15px;" />
                            <span class="fl">男</span></label>
                        <label><input name="" type="radio" value="女" class="fl" style=" margin:4px ; margin-left:15px;" />
                            <span class="fl">女</span></label>						</td>
                </tr>
                <tr>
                    <td width="80" align="right" class="color2">真实姓名</td>
                    <td><input type="text" class="oto_text_one oto_text_two fl" name="textfield" /></td>
                </tr>
                <tr>
                    <td width="80" align="right" class="color2">身份证号码</td>
                    <td><input type="text" class="oto_text_one fl" name="textfield" /></td>
                </tr>
                <tr>
                    <td width="80" align="right" valign="top" class="color2">所在地</td>
                    <td><div class="" style="width:100% ; height:35px">
                        <select class="oto_select add_sheng fl">
                            <option value="安徽省">安徽省</option>
                            <option value="安徽省">安徽省</option>
                            <option value="安徽省">安徽省</option>
                        </select>
                        <select class="oto_select add_shi fl">
                            <option value="合肥市">合肥市</option>
                            <option value="合肥市">合肥市</option>
                            <option value="合肥市">合肥市</option>
                        </select>
                        <select class="oto_select add_qu fl">
                            <option value="瑶海区">瑶海区</option>
                            <option value="瑶海区">瑶海区</option>
                            <option value="瑶海区">瑶海区</option>
                        </select>
                    </div>
                        <div class="" style="width:100% ; height:35px">
                            <input type="text" class="oto_text_one fl" name="textfield" value="请输入详细地址" style="width:360px" />
                        </div>						</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td><button class="btn_baocun">保存修改</button></td>
                </tr>
            </table>

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
