<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\account\info.html";i:1535689540;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1535707668;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/static/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/vendor/icheck/skins/flat/blue.css">
    <link rel="stylesheet" href="/static/vendor/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/static/vendor/select/css/bootstrap-select.min.css">
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
    <script src="/static/js/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
    <script src="/static/vendor/bootstrap-validate/js/language/zh_CN.js"></script>
    <script src="/static/vendor/cxselect/jquery.cxselect.min.js"></script>
    <script src="/static/vendor/icheck/icheck.min.js"></script>
    <script type="text/javascript" src="/static/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/static/vendor/select/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/static/vendor/datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
    <script src="/static/js/tipSuppliers.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/system/vendor.js"></script>
</head>
<body>
<input type="hidden" id="apitoken" value="<?php echo $api_token; ?>">

<body >
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>账户管理</a></li>
        <li class="active">账户信息</li>
    </ol>
    <div class="row col-lg-12">
        <div class="col-lg-3 info-header-bar btn-warning">
            <i class="glyphicon glyphicon-jpy"></i>商户余额:<?php echo $base['balance']; ?>
        </div>
        <div class="col-lg-3 info-header-bar btn-success">
            <i class="glyphicon glyphicon-list-alt"></i>订单数量:<?php echo $base['orderNumber']; ?>
        </div>
        <div class="col-lg-3 info-header-bar">

        </div>
        <div class="col-lg-3 info-header-bar">

        </div>
    </div>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#base" data-toggle="tab">商户信息</a>
        </li>
        <li><a href="#detail" data-toggle="tab">资料中心</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="base">
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-heading">
                    <h3>基本信息</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">商户名称：<?php echo $base['name']; ?></li>
                    <li class="list-group-item">商户编号：<?php echo $base['signNumber']; ?></li>
                    <li class="list-group-item">商户余额：<?php echo (isset($base['balance']) && ($base['balance'] !== '')?$base['balance']:0); ?></li>
                    <li class="list-group-item">保&nbsp;证&nbsp;&nbsp;金：<?php echo (isset($base['bond']) && ($base['bond'] !== '')?$base['bond']:0); ?></li>
                    <li class="list-group-item">时用状态：<?php echo $base['status']['text']; ?></li>
                    <li class="list-group-item">联系邮箱：<?php echo (isset($base['email']) && ($base['email'] !== '')?$base['email']:''); ?></li>
                    <li class="list-group-item">开通时间：<?php echo (isset($base['createdTime']) && ($base['createdTime'] !== '')?$base['createdTime']:''); ?></li>
                </ul>
            </div>
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-heading">
                    <h3>商户通道</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed fixed-table-body">
                        <thead>
                        <tr>
                            <th>通道名称</th>
                            <th>入金- 通道费率</th>
                            <th>出金- 通道费率</th>
                            <th>单笔- 最低限额</th>
                            <th>单笔- 最高限额</th>
                        </thead>
                        <tbody>
                        <?php if(is_array($gateway) || $gateway instanceof \think\Collection || $gateway instanceof \think\Paginator): $i = 0; $__LIST__ = $gateway;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['depositeRate']; ?></td>
                            <td><?php echo $item['withdrawRate']; ?></td>
                            <td><?php echo $item['minAmount']; ?></td>
                            <td><?php echo $item['maxAmount']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="detail">
            <div class="panel panel-default" style="margin-top:30px;">
                <!--<div class="panel-heading">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myFormModal">修改信息
                    </button>
                </div>-->
                <ul class="list-group">
                    <li class="list-group-item">真实姓名：<?php echo $detail['realName']; ?></li>
                    <li class="list-group-item">身份证号：<?php echo $detail['idNumber']; ?></li>
                    <li class="list-group-item">公司地址：<?php echo $detail['region']['0']; ?> <?php echo $detail['region']['1']; ?> <?php echo $detail['region']['2']; ?></li>
                    <li class="list-group-item">详细地址：<?php echo $detail['address']; ?></li>
                    <li class="list-group-item">营业执照：<?php echo $detail['business']; ?></li>
                    <li class="list-group-item">营业执照副本：<?php if($detail['businessCard']): ?>
                        <button class="btn btn-sm btn-info" onclick="modal_image('营业执照副本','<?php echo $detail['businessCard']; ?>');">
                            预览
                        </button>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">法人身份证A&nbsp;：<?php if($detail['legalCarda']): ?>
                        <button class="btn btn-sm btn-info" onclick="modal_image('法人身份证A','<?php echo $detail['legalCarda']; ?>');">预览
                        </button>
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">法人身份证B&nbsp;：<?php if($detail['legalCardb']): ?>
                        <button class="btn btn-sm btn-info" onclick="modal_image('法人身份证B','<?php echo $detail['legalCardb']; ?>');">预览
                        </button>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade right" id="myFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form class="form-horizontal" role="form" id="merchatInfoForm" action="<?php echo url('saveDetail'); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">修改详细信息</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $detail['id']; ?>">
                        <?php echo formInput('真实姓名:','realName',$detail['realName'],'text',[['rule'=>'notempty']],true); ?>
                        <?php echo formInput('身份证号:','idNumber',$detail['idNumber'],'text',[['rule'=>'notempty']],true); ?>
                        <div class="form-group" id="company_region">
                            <label class="col-sm-2 control-label">公司地区:</label>
                            <div class="col-sm-10 cxselect-list">
                                <select class="province form-control " name="region" data-value="<?php echo $detail['region']['0']; ?>"
                                        data-first-title="选择省" disabled="disabled" required
                                        data-required-msg="选择省"></select>
                                <select class="city form-control" name="region" data-value="<?php echo $detail['region']['1']; ?>"
                                        data-first-title="选择市"
                                        disabled="disabled" required data-required-msg="选择市"></select>
                                <select class="area form-control" name="region" data-value="<?php echo $detail['region']['2']; ?>"
                                        data-first-title="选择地区"
                                        disabled="disabled" required data-required-msg="选择地区"></select>
                            </div>
                        </div>
                        <?php echo formInput('详细地址:','address',$detail['address'],'text',[['rule'=>'notempty']]); ?>
                        <?php echo formInput('营业执照:','business',$detail['business'],'text',[['rule'=>'notempty']]); ?>
                        <?php echo formInput('法人名称:','legalName',$detail['legalName'],'text',[['rule'=>'notempty']]); ?>
                        <?php echo formFile(true,'法人身份证A:','legalCarda',$detail['legalCarda'],$detail['legalCarda']); ?>
                        <?php echo formFile(false,'法人身份证B:','legalCardb',$detail['legalCardb'],$detail['legalCardb']); ?>
                        <?php echo formFile(false,'营业执照副本:','businessCard',$detail['businessCard'],$detail['businessCard']); ?>
                    </div>
                    <div class="modal-footer modal-my-bottom">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
</body>
</html>