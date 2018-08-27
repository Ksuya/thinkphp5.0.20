<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:92:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/merchat\view\security\index.html";i:1535012054;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1535361155;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/static/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/vendor/icheck/skins/flat/grey.css">
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

<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>安全设置</a></li>
        <li class="active">安全设置</li>
    </ol>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#modifyPwd" data-toggle="tab">修改登录密码</a>
        </li>
        <li><a href="#withdrawPwd" data-toggle="tab">提现口令</a></li>
        <li><a href="#developData" data-toggle="tab">开发资料</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="modifyPwd">
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="<?php echo url('modifyPwd'); ?>">
                        <?php echo token('token_mod_pwd', 'sha1'); ?>
                        <?php echo formInput('旧密码:','oldPassword','','password'); ?>
                        <?php echo formInput('新密码:','newPassword','','password'); ?>
                        <?php echo formInput('确认密码:','renewPassword','','password',[['rule'=>'identical','name'=>'新密码','field'=>'newPassword'],['rule'=>'notempty']]); ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="withdrawPwd">
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="<?php echo url('modifyWithdrawPwd'); ?>">.
                        <?php echo token('token_mod_withpwd', 'md5'); ?>
                        <?php echo formInput('旧口令:','oldCommand','','password'); ?>
                        <?php echo formInput('新口令:','newCommand','','password'); ?>
                        <?php echo formInput('确认口令:','renewCommand','','password',[['rule'=>'identical','name'=>'新口令','field'=>'newCommand'],['rule'=>'notempty']]); ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="developData">
            <div class="panel panel-default" style="margin-top:30px;">
                <ul class="list-group">
                    <li class="list-group-item">商户编码：<?php echo $base['signNumber']; ?></li>
                    <li class="list-group-item">商户密钥：<?php echo $base['signKey']; ?></li>
                    <li class="list-group-item">文档下载：<a href="/resource/demo/api/4ds4dsdslkdls.zip"><button type="button" class="btn btn-info">下载</button></a></li>
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
                        <?php echo formInput('真实姓名:','realName','','text'); ?>
                        <?php echo formInput('身份证号:','idNumber','','text'); ?>

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

</script>
</body>
</html>