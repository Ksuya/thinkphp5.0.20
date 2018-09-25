<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"D:\phpStudy\PHPTutorial\WWW\payment\public/../application/manager\view\shop\order\index.html";i:1536327106;s:83:"D:\phpStudy\PHPTutorial\WWW\payment\application\common\view\public\admin-table.html";i:1536327106;s:84:"D:\phpStudy\PHPTutorial\WWW\payment\application\common\view\public\admin-header.html";i:1536327106;}*/ ?>
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
    <label class="myLabel-content">订单编号：</label>
    <div class="myText-content">
        <input type="text" name="order_no" class="form-control" placeholder="输入订单编号">
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">下单用户：</label>
    <div class="myText-content">
        <select class="form-control" name="user_id">
            <option value="">全部</option>
            <?php foreach($user as $v): ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['nick_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">订单状态：</label>
    <div class="myText-content">
        <select class="form-control" name="status">
            <option value="">全部</option>
            <option value="0">未支付</option>
            <option value="1">支付成功</option>
        </select>
    </div>
</div>
<div class="my-container">
    <label class="myLabel-content">下单时间：</label>
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
                    
<button type="button" class="btn btn-danger table-more-action" data-callback="merchatWithdraw"
        data-table="tb_departments" data-status="-1">批量删除
</button>
<button type="button" class="btn btn-danger table-more-action" data-callback="merchatWithdraw"
        data-table="tb_departments" data-status="-1">批量发货
</button>

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

<div class="modal fade right" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">订单详情</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer modal-my-bottom">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade right" id="send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form"  action="<?php echo url('sendExp'); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel2">发货</h4>
                </div>
                <div class="modal-body">
                    <?php echo token('token_order_actions','shal'); ?>
                    <input type="hidden" name="id" value="">
                    <?php echo formSelect('快递公司:','express_id',[
                        ['id'=>'ems','name'=>'ems快递'],
                        ['id'=>'shentong','name'=>'申通快递'],
                        ['id'=>'yuantong','name'=>'圆通速递'],
                        ['id'=>'shunfeng','name'=>'顺丰速运'],
                        ['id'=>'tiantian','name'=>'天天快递'],
                        ['id'=>'yunda','name'=>'韵达快递'],
                        ['id'=>'zhongtong','name'=>'中通速递'],
                        ['id'=>'longbanwuliu','name'=>'龙邦物流'],
                        ['id'=>'zhaijisong','name'=>'宅急送'],
                        ['id'=>'deppon','name'=>'德邦物流'],
                    ],'id','name'); ?>
                    <?php echo formInput('快递单号:','express_code',''); ?>
                </div>
                <div class="modal-footer modal-my-bottom">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary form-ajax-submit">发货</button>
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
        {field: 'order_no', title: '订单编号'},
        {field: 'user_name', title: '下单用户'},
        {field: 'order_amount', title: '订单金额'},
        {field: 'pay_type', title: '支付方式',formatter:function (value) {
                return value.name;
            }},
        {field: 'status', title: '订单状态',formatter:function (value) {
                return value.name;
            }},
        {field: 'progress', title: '物流状态',formatter:function (value) {
                return value.name;
            }},
        {field: 'desc', title: '订单描述'},
        {field: 'create_time', title: '下单时间', sortable: true},
        {
            field: '', title: '操作', formatter: function (value, row, index) {
                if(row.progress.id == 1){
                    return generateTableAtions(row, 'id',[
                        {'name':'详情','class':'btn-info row-order-info','modal':"detail"},
                        {'name':'发货','class':'btn-success row-order-send','modal':"send"}
                    ]);
                }else{
                    return generateTableAtions(row, 'id',[
                        {'name':'详情','class':'btn-info row-order-info','modal':"detail"}
                    ]);
                }

        }}
    ];
    var sortName = 'a.create_time';
    var sortOrder = 'desc';
</script>

<script src="/static/system/table.js"></script>
</body>
</html>