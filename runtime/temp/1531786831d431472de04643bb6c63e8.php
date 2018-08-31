<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\blogb\category.html";i:1535696194;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1535439553;}*/ ?>
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

<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet"/>
<link href="/static/vendor/tree/css/bootstrap-treeview.css" rel="stylesheet"/>
<script src="/static/vendor/table/bootstrap-table.js"></script>
<script src="/static/vendor/tree/js/bootstrap-treeview.js"></script>
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>博客管理</a></li>
        <li class="active">栏目管理</li>
    </ol>
    <div class="row">
        <div class="col-sm-2">
            <div id="tree"></div>
        </div>
        <div class="col-sm-10 row-right">
            <div id="toolbar" class="btn-group">
                <div id="table-btn-list">
                    <form action="" id="searchTableForm">
                        <div class="my-container">
                            <label class="myLabel-content">流水号：</label>
                            <div class="myText-content">
                                <input type="text" name="transaction" class="form-control" placeholder="输入流水号">
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
                    <button type="button" class="btn btn-danger table-more-action"
                            data-callback="merchatWithdraw" data-table="tb_departments" data-status="-1">批量拒绝
                    </button>
                    <button type="button" class="btn btn-success table-more-action"
                            data-callback="merchatWithdraw" data-table="tb_departments" data-status="1">批量处理
                    </button>
                </div>
            </div>
            <table id="tb_departments" class="table table-hover table-striped table-extra"></table>
        </div>
    </div>
</div>
<div class="modal fade right" id="withdrawFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form class="form-horizontal" role="form" id="merchatWithdrawForm" action="<?php echo url('saveWithdraw'); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">提现申请</h4>
                </div>
                <div class="modal-body">
                    <?php echo formInput('栏目名称:','name','','text'); ?>
                    <?php echo formSelect('上级栏目:','parent_id',$menus,'id','name'); ?>
                    <?php echo formInput('栏目描述:','description','','text'); ?>
                    <?php echo formInput('栏目排序:','sort','','number'); ?>
                    <?php echo formCheck('radio','导航显示','is_menu',[['id'=>0,'name'=>'否'],['id'=>1,'name'=>'是']],'id','name'); ?>
                    <?php echo formInput('添加时间','create_time','','date',[['rule'=>'notempty'],['rule'=>'date']]); ?>
                </div>
                <div class="modal-footer modal-my-bottom">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary form-ajax-submit">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        //1.初始化Table
        var url = "<?php echo url('categoryList'); ?>";
        var tableId = 'tb_departments';
        var fields = [
            {checkbox: true},
            {field: 'name', title: '栏目名称'},
            {field: 'parent_name', title: '上级栏目', sortable: true},
            {field: 'description', title: '栏目描述', sortable: true},
            {field: 'sort', title: '栏目排序', sortable: true},
            {
                field: 'is_menu', title: '导航显示', formatter: function (value) {
                    return value.text;
                }
            },
            {field: 'create_time', title: '添加时间', sortable: true},
        ];
        var oTable = new TableInit();
        oTable.Init(tableId, url, fields, 'a.create_time', 'desc','searchTableForm');
        var tree = [
            {
                text: "Parent 1",
                nodes: [
                    {
                        text: "Child 1",
                        nodes: [
                            {
                                text: "Grandchild 1"
                            },
                            {
                                text: "Grandchild 2"
                            }
                        ]
                    },
                    {
                        text: "Child 2"
                    }
                ]
            },
            {
                text: "Parent 2"
            },
            {
                text: "Parent 3"
            },
            {
                text: "Parent 4"
            },
            {
                text: "Parent 5"
            }
        ];
        $('#tree').treeview({
            data: tree,         // 数据源
            showCheckbox: false,   //是否显示复选框
            highlightSelected: true,    //是否高亮选中
            //nodeIcon: 'glyphicon glyphicon-user',    //节点上的图标
            //nodeIcon: 'glyphicon glyphicon-globe',
            emptyIcon: '',    //没有子节点的节点图标
            multiSelect: false,    //多选
            onNodeChecked: function (event,data) {
                alert(data.nodeId);
            },
            onNodeSelected: function (event, data) {
                alert(data.nodeId);
            }
        });
    });
</script>
</body>
</html>