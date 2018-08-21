<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:99:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\public/../application/merchat\view\account\info.html";i:1534772527;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-header.html";i:1534770075;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-script.html";i:1534770075;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/js/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/static/js/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/js/vendor/icheck/skins/flat/green.css">
    <link rel="stylesheet" href="/static/js/vendor/datepicker/css/bootstrap-datepicker.min.css">
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
</head>
<body>

<body class="in-frame">
<div class="row">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>账户管理</a></li>
        <li class="active">账户信息</li>
    </ol>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#base" data-toggle="tab">基本信息</a>
        </li>
        <li><a href="#detail" data-toggle="tab">详细信息</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="base">
            <div class="panel panel-default" style="margin-top:30px;">
                <ul class="list-group">
                    <li class="list-group-item">商户名称：<?php echo $base['name']; ?></li>
                    <li class="list-group-item">商户编号：<?php echo $base['sign_number']; ?></li>
                    <li class="list-group-item">商户余额：<?php echo (isset($base['balance']) && ($base['balance'] !== '')?$base['balance']:0); ?></li>
                    <li class="list-group-item">保&nbsp;证&nbsp;&nbsp;金：<?php echo (isset($base['bond']) && ($base['bond'] !== '')?$base['bond']:0); ?></li>
                    <li class="list-group-item">时用状态：<?php echo $base['status']; ?></li>
                    <li class="list-group-item">联系邮箱：<?php echo (isset($base['email']) && ($base['email'] !== '')?$base['email']:''); ?></li>
                    <li class="list-group-item">开通时间：<?php echo (isset($base['created_time']) && ($base['created_time'] !== '')?$base['created_time']:''); ?></li>
                </ul>

            </div>
        </div>
        <div class="tab-pane fade" id="detail">
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-heading">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myFormModal">修改信息
                    </button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">真实姓名：<?php echo $detail['real_name']; ?></li>
                    <li class="list-group-item">身份证号：<?php echo $detail['id_number']; ?></li>
                    <li class="list-group-item">公司地址：<?php echo $detail['region']; ?></li>
                    <li class="list-group-item">详细地址：<?php echo $detail['address']; ?></li>
                    <li class="list-group-item">营业执照：<?php echo $detail['business']; ?></li>
                    <li class="list-group-item">法人姓名：<?php echo $detail['legal_name']; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="myFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form class="form-horizontal" role="form" id="merchatInfoForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">修改详细信息</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo formInput('真实姓名','real_name',$detail['real_name'],'text',[['rule'=>'notempty']]); ?>
                        <?php echo formInput('身份证号','id_number',$detail['id_number'],'text',[['rule'=>'notempty']]); ?>
                        <?php echo formSelect('性别','gender',[['id'=>2,'name'=>'测试1']],'id','name'); ?>
                        <div class="form-group" id="company_region">
                            <label class="col-sm-2 control-label">公司省市</label>
                            <div class="col-sm-10 cxselect-list">
                                <select class="province form-control" name="region" data-value="浙江省"
                                        data-first-title="选择省" disabled="disabled" required
                                        data-required-msg="选择省"></select>
                                <select class="city form-control" name="region" data-value="杭州市" data-first-title="选择市"
                                        disabled="disabled" required data-required-msg="选择市"></select>
                                <select class="area form-control" name="region" data-value="西湖区" data-first-title="选择地区"
                                        disabled="disabled" required data-required-msg="选择地区"></select>
                            </div>
                        </div>
                        <?php echo formCheck('radio','单选框','uniqj',[['id'=>2,'name'=>'测试1'],['id'=>3,'name'=>'测试2']],'id','name','3'); ?>
                        <?php echo formCheck('checkbox','您的爱好','habits',[['id'=>2,'name'=>'爱好1'],['id'=>3,'name'=>'爱好2'],['id'=>4,'name'=>'爱好4']],'id','name','3,4'); ?>
                        <?php echo formEditor('文章内容','content'); ?>
                        <?php echo formInput('开始时间','start_time','','date',[['rule'=>'notempty'],['rule'=>'date']]); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--javascript include-->
<script src="/static/js/jquery-2.2.1.min.js"></script>
<script src="/static/js/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/static/js/vendor/layer/layer.js"></script>
<script src="/static/js/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
<script src="/static/js/vendor/bootstrap-validate/js/language/zh_CN.js"></script>
<script src="/static/js/vendor/cxselect/jquery.cxselect.min.js"></script>
<script src="/static/js/vendor/icheck/icheck.min.js"></script>
<script type="text/javascript" src="/static/js/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/static/js/vendor/datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<script src="/static/js/tipSuppliers.js"></script>
<script src="/static/system/core.js"></script>
<script src="/static/system/vendor.js"></script>


<script>
    $(function () {
        // 全国省市区
        $('#company_region').cxSelect({
            selects: ['province', 'city', 'area'],
            nodata: 'none',
            url:'/static/js/vendor/cxselect/cityData.min.json',
        });
    });
    /**
     * ckedior 同步内容到texarea
     */
    function sendPost() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    }
</script>
</body>
</html>