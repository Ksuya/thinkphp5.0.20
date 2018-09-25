<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:93:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/manager\view\shop\member\index.html";i:1536327106;s:83:"D:\phpStudy\PHPTutorial\WWW\payment\application\common\view\public\admin-table.html";i:1536327106;s:84:"D:\phpStudy\PHPTutorial\WWW\payment\application\common\view\public\admin-header.html";i:1536327106;}*/ ?>
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
<link rel="stylesheet" href="/static/vendor/icheck/skins/flat/blue.css">
<link rel="stylesheet" href="/static/vendor/datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/static/vendor/select/css/bootstrap-select.min.css">
<script src="/static/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
<script src="/static/vendor/bootstrap-validate/js/language/zh_CN.js"></script>
<script src="/static/vendor/cxselect/jquery.cxselect.min.js"></script>
<script src="/static/vendor/icheck/icheck.min.js"></script>
<script type="text/javascript" src="/static/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/static/vendor/select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/static/vendor/datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet"/>
<link href="/static/vendor/tree/css/bootstrap-treeview.css" rel="stylesheet"/>
<script src="/static/vendor/table/bootstrap-table.js"></script>
<script src="/static/vendor/tree/js/bootstrap-treeview.js"></script>
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body style="overflow: auto">
<div class="panel-body">
    
<ol class="breadcrumb">
    <li><a>首页</a></li>
    <li><a>商城管理</a></li>
    <li class="active">分类管理</li>
</ol>

    
    

            <div id="toolbar" class="btn-group">
                <div id="table-btn-list">
                    <form action="" id="tb_departments_SearchTableForm">
                        
<div class="my-container">
    <label class="myLabel-content">用户昵称：</label>
    <div class="myText-content">
        <input type="text" name="nick_name" class="form-control" placeholder="输入昵称">
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">联系电话：</label>
    <div class="myText-content">
        <input type="text" name="phone" class="form-control" placeholder="输入联系电话">
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">电子邮箱：</label>
    <div class="myText-content">
        <input type="text" name="email" class="form-control" placeholder="输入电子邮箱">
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">创建时间：</label>
    <div class="myText-content">
        <input type="text" name="start" class="form-control datepicker" placeholder="输入开始时间">
    </div>
    <div class="myText-content">
        <input type="text" name="end" class="form-control datepicker" placeholder="输入结束时间">
    </div>
</div>

                        <div class="myBtn-content">
                            <button type="button" class="btn btn-primary table-btn-search" data-table="tb_departments">搜索</button>
                            <button type="button" class="btn btn-default table-btn-reset" data-table="tb_departments">重置</button>
                            
                            
                        </div>
                    </form>
                </div>
                <div id="table-btn-moreaction-list" style="display: none;">
                    <span>您选中了 <span id="row-select-total"></span> 行 </span>
                    

                </div>
            </div>
            <table id="tb_departments" class="table table-hover table-striped table-extra"></table>
    
    
</div>
<div class="modal fade right" id="tb_departments_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form"  action="<?php echo url('store'); ?>">
                
                
                <div class="modal-footer modal-my-bottom">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var tableId = 'tb_departments';
    var url = "<?php echo url('dataList'); ?>";
    var delurl = "<?php echo url('delData'); ?>";
    var formModal = 'tb_departments_Modal';
    var fields = [
        {checkbox: true},
        {field: 'email', title: '电子邮箱'},
        {field: 'phone', title: '联系电话'},
        {field: 'nick_name', title: '昵称'},
        {field: 'real_name', title: '真实姓名'},
        {field: 'region', title: '所在地区'},
        {field: 'address', title: '详细地址'},
        {field: 'create_time', title: '创建时间', sortable: true},
    ];
    var sortName = 'a.create_time';
    var sortOrder = 'desc';
</script>

<script src="/static/system/table.js"></script>
</body>
</html>