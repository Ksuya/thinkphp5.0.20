<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:94:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/merchat\view\account\withdraw.html";i:1534940046;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1534853416;}*/ ?>
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
<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet"/>
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>账户管理</a></li>
        <li class="active">提现记录</li>
    </ol>

    <div id="toolbar" class="btn-group">
        <div id="table-btn-list">
            <form action="">
                <div class="my-container">
                    <label class="myLabel-content">流水号：</label>
                    <div class="myText-content">
                        <input type="text" name="transaction" class="form-control" placeholder="输入乘车码">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">提现状态：</label>
                    <div class="myText-content">
                        <select class="form-control" name="a.status">
                            <option value="">请选择</option>
                            <option value="-1">拒绝</option>
                            <option value="0">处理中</option>
                            <option value="1">处理成功</option>
                            <option value="2">处理失败</option>
                        </select>
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">开始：</label>
                    <div class="myText-content">
                        <input  type="text" name="start" class="form-control datepicker" placeholder="输入开始时间">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">结束：</label>
                    <div class="myText-content">
                        <input  type="text" name="end" class="form-control datepicker" placeholder="输入结束时间">
                    </div>
                </div>
                <div class="myBtn-content">
                    <button type="button" class="btn btn-primary table-btn-search" data-table="tb_departments">搜索</button>
                    <button type="button" class="btn btn-default table-btn-reset" data-table="tb_departments">重置</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#withdrawFormModal">申请提现</button>
                </div>
            </form>
        </div>
        <div id="table-btn-moreaction-list" style="display: none;">
            <span>您选中了 <span id="row-select-total"></span> 行 </span>
            <button type="button" class="btn btn-danger"
                    data-callback="merchatWithdraw" data-table="tb_departments" data-status="-1">批量拒绝
            </button>
            <button type="button" class="btn btn-success"
                    data-callback="merchatWithdraw" data-table="tb_departments" data-status="1">批量处理
            </button>
        </div>
    </div>
    <table id="tb_departments" class="extra-table"></table>
</div>
<div class="modal fade right" id="withdrawFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form class="form-horizontal" role="form" id="merchatWithdrawForm" action="<?php echo url('withdraw'); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">提现申请</h4>
                </div>
                <div class="modal-body">
                    <?php echo formInput('提现金额:','order_amount','','text',[['rule'=>'notempty']]); ?>
                    <?php echo formSelect('选择银行卡:','bank_id',$merBanks,'id','openBank'); ?>
                    <div class="form-group" id="company_region">
                        <label class="col-sm-2 control-label">开户行省市:</label>
                        <div class="col-sm-10 cxselect-list">
                            <select class="province form-control " name="region" data-value=""
                                    data-first-title="选择省" disabled="disabled" required
                                    data-required-msg="选择省"></select>
                            <select class="city form-control" name="region" data-value="" data-first-title="选择市"
                                    disabled="disabled" required data-required-msg="选择市"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 全国省市区
        $('#company_region').cxSelect({
            selects: ['province', 'city'],
            nodata: 'none',
            url:'/static/vendor/cxselect/cityData.min.json',
            required:true,
        });
        //1.初始化Table
        var url = "<?php echo url('btData'); ?>";
        var tableId = 'tb_departments';
        var fields = [
            {checkbox: true},
            {field: 'merchat', title: '商户名称'},
            {field: 'transaction', title: '提现流水号', sortable: true},
            {field: 'order_amount', title: '提现金额', sortable: true},
            {field: 'service_charge', title: '提现手续费', sortable: true},
            {
                field: 'status', title: '状态', formatter: function (value) {
                    return value.text;
                }
            },
            {field: 'created_time', title: '创建时间', sortable: true},
            {field: 'deal_user', title: '处理人'},
            {
                field: '', title: '操作', formatter: function (value, row) {
                    var action = '';
                    var jsonParam = JSON.stringify(row);
                    switch (row.status['value']) {
                        case 0:
                            action = action + '<button class="btn btn-sm btn-success table-row-action" data-row=\'' + jsonParam + '\' data-callback="merchatWithdraw" data-table="' + tableId + '">处理</button>';
                            break;
                        case 2:
                            action = action + '<button class="btn btn-sm btn-danger table-row-action" data-row=\'' + jsonParam + '\' data-callback="merchatWithdraw" data-table="' + tableId + '">重新处理</button>';
                            break;
                        default:
                            break;
                    }
                    return action;
                }
            },
        ];
        var oTable = new TableInit();
        oTable.Init(tableId, url, fields, 'created_time', 'desc');
    });
</script>
</body>
</html>