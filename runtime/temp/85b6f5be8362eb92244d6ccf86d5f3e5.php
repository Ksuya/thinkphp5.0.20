<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\order\index.html";i:1535363593;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1535439553;}*/ ?>
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

<script src="/static/vendor/table/bootstrap-table.js"></script>
<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet"/>
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>交易查询</a></li>
        <li class="active">订单查询</li>
    </ol>
    <div id="toolbar" class="btn-group">
        <div id="table-btn-list">
            <form action="">
                <div class="my-container">
                    <label class="myLabel-content">流水号：</label>
                    <div class="myText-content">
                        <input type="text" name="transaction" class="form-control" placeholder="输入流水号">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">商户订单号：</label>
                    <div class="myText-content">
                        <input type="text" name="orderNo" class="form-control" placeholder="输入商户订单号">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">订单状态：</label>
                    <div class="myText-content">
                        <select class="form-control" name="a.status">
                            <option value="">全部</option>
                            <option value="0000">支付成功</option>
                            <option value="0001">已提交</option>
                            <option value="0002">支付失败</option>
                            <option value="0003">通知失败</option>
                            <option value="0004">已退款</option>
                            <option value="0005">已关闭</option>
                        </select>
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">交易通道：</label>
                    <div class="myText-content">
                        <select class="form-control" name="a.gatewayId">
                            <option value="">全部</option>
                            <?php if(is_array($gateways) || $gateways instanceof \think\Collection || $gateways instanceof \think\Paginator): $i = 0; $__LIST__ = $gateways;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($item['id'] != 3): ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">交易时间：</label>
                    <div class="myText-content">
                        <input  type="text" name="start" class="form-control datepicker" placeholder="输入开始时间">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">--</label>
                    <div class="myText-content">
                        <input  type="text" name="end" class="form-control datepicker" placeholder="输入结束时间">
                    </div>
                </div>
                <div class="myBtn-content">
                    <button type="button" class="btn btn-primary table-btn-search" data-table="tb_departments">搜索</button>
                    <button type="button" class="btn btn-default table-btn-reset" data-table="tb_departments">重置</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#withdrawFormModal">导出订单</button>
                </div>
            </form>
        </div>
        <div id="table-btn-moreaction-list" style="display: none;">
            <span>您选中了 <span id="row-select-total"></span> 行 </span>
            <button type="button" class="btn btn-success"
                    data-callback="merchatWithdraw" data-table="tb_departments" data-status="1">批量导出
            </button>
        </div>
    </div>
    <table id="tb_departments" class="extra-table"></table>
</div>
<script>
    $(function () {
        //1.初始化Table
        var url = "<?php echo url('merchatOrder'); ?>";
        var tableId = 'tb_departments';
        var fields = [
            {checkbox: true},
            {field: 'orderNo', title: '商户订单号'},
            {field: 'transaction', title: '平台流水号'},
            {field: 'orderAmount', title: '交易金额', sortable: true},
            {field: 'serviceCharge', title: '交易手续费', sortable: true},
            {field: 'gatewayName', title: '交易通道'},
            {field: 'status', title: '交易状态',formatter: function (value) {
                return value.text;
            }},
            {field: 'notifyNumber', title: '通知次数'},
            {field: 'bankCardType', title: '交易属性'},
            {field: 'bankCode', title: '交易机构'},
            {field: 'createdTime', title: '创建时间', sortable: true},
        ];
        var oTable = new TableInit();
        oTable.Init(tableId, url, fields, 'createdTime', 'desc');
    });
</script>
</body>
</html>