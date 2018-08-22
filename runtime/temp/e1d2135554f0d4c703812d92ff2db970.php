<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:103:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\public/../application/merchat\view\account\withdraw.html";i:1534905441;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-header.html";i:1534855457;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/static/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/vendor/icheck/skins/flat/green.css">
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

<script src="/static/vendor/table/bootstrap-table.js"></script>
<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet" />
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>账户管理</a></li>
        <li class="active">体现记录</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">查询条件</div>
        <div class="panel-body">
            <form id="formSearch" class="form-horizontal">
                <div class="form-group" style="margin-top:15px">
                    <label class="control-label col-sm-1" for="txt_search_departmentname">部门名称</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="txt_search_departmentname">
                    </div>
                    <label class="control-label col-sm-1" for="txt_search_statu">状态</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="txt_search_statu">
                    </div>
                    <div class="col-sm-4" style="text-align:left;">
                        <button type="button" style="margin-left:50px" id="btn_query" class="btn btn-primary">查询</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="toolbar" class="btn-group">
        <div id="table-btn-list">
        </div>
        <div id="table-btn-moreaction-list" style="display: none;">
            <label>您选中了 <span id="row-select-total"></span> 行 </label>
            <button  type="button" class="btn btn-danger glyphicon glyphicon-plus table-more-action" data-callback="merchatWithdraw" data-table="tb_departments" data-status="-1">批量拒绝</button>
            <button  type="button" class="btn btn-success glyphicon glyphicon-pencil table-more-action" data-callback="merchatWithdraw" data-table="tb_departments" data-status="1">批量处理</button>
        </div>
    </div>
    <table id="tb_departments" class="extra-table"></table>
</div>
<script>
    $(function () {
        //1.初始化Table
        var url = "<?php echo url('btData'); ?>";
        var tableId = 'tb_departments';
        var fields = [
            {checkbox: true},
            {field: 'merchat',title: '商户名称'},
            {field: 'transaction',title: '提现流水号',sortable:true},
            {field:'order_amount',title:'提现金额',sortable:true},
            {field:'service_charge',title:'提现手续费',sortable:true},
            {field:'status',title:'状态',formatter:function (value) {
                return value.text;
            }},
            {field:'created_time',title:'创建时间',sortable:true},
            {field:'deal_user',title:'处理人'},
            {field:'',title:'操作',formatter:function (value,row) {
                var action = '';
                var jsonParam = JSON.stringify(row);
                switch (row.status['value']){
                    case 0:
                        action = action + '<button class="btn btn-sm btn-success table-row-action" data-row=\''+jsonParam+'\' data-callback="merchatWithdraw" data-table="'+tableId+'">处理</button>';
                        break;
                    case 2:
                        action = action + '<button class="btn btn-sm btn-danger table-row-action" data-row=\''+jsonParam+'\' data-callback="merchatWithdraw" data-table="'+tableId+'">重新处理</button>';
                        break;
                    default:
                        break;
                }
                return action;
            }},
        ];
        var oTable = new TableInit();
        oTable.Init(tableId,url,fields,'created_time','desc');
    });
</script>
</body>
</html>