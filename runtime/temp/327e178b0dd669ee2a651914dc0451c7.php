<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/manager\view\shop\config\index.html";i:1536327106;s:84:"D:\phpStudy\PHPTutorial\WWW\payment\application\common\view\public\admin-header.html";i:1536327106;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
    <script src="/static/js/jquery-2.2.1.min.js"></script>
    <script src="/static/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/js/tipSuppliers.js"></script>
    <script src="/static/system/core.js"></script>
    <script src="/static/system/vendor.js"></script>
    <script>
        $(document).ready(function () {
            $("#apitoken").val("<?php echo $api_token; ?>");
        });
    </script>
</head>
<body>
<input type="hidden" id="apitoken" value="">

<link rel="stylesheet" href="/static/vendor/bootstrap-validate/css/bootstrapValidator.css">
<script src="/static/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>商城管理</a></li>
        <li class="active">商城配置</li>
    </ol>
    <form class="form-horizontal" role="form" action="<?php echo url('saveConf'); ?>">
        <input type="hidden" name="config_id" value="1">
        <?php echo formInput('站点名称:','site_name',$conf['site_name'],'text'); ?>
        <?php echo formInput('版权信息:','copy_right',$conf['copy_right'],'text'); ?>
        <?php echo formInput('地址信息:','address',$conf['address'],'text'); ?>
        <?php echo formInput('联系方式:','contact',$conf['contact'],'text'); ?>
        <?php echo formInput('备案标号:','icp',$conf['icp'],'text'); ?>
        <?php echo formFile('站点LOGO','site_logo',1,[$conf['site_logo_path']],$conf['site_logo']); ?>
        <div class="form-group"><label  class="col-sm-2 control-label"></label>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>