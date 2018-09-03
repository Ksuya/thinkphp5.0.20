<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:96:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\shop\product\index.html";i:1535957826;s:86:"E:\phpstudy2018\PHPTutorial\WWW\newtp\application\common\view\public\admin-header.html";i:1535951938;}*/ ?>
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
    <script>
        $(document).ready(function () {
            $("#apitoken").val("<?php echo $api_token; ?>");
        });
    </script>
</head>
<body>
<input type="hidden" id="apitoken" value="">

<link href="/static/vendor/table/bootstrap-table.css" rel="stylesheet"/>
<link href="/static/vendor/tree/css/bootstrap-treeview.css" rel="stylesheet"/>
<script src="/static/vendor/table/bootstrap-table.js"></script>
<script src="/static/vendor/tree/js/bootstrap-treeview.js"></script>
<script src="/static/vendor/table/locale/bootstrap-table-zh-CN.js"></script>
<body>
<div class="panel-body">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>商城管理</a></li>
        <li class="active">商品管理</li>
    </ol>
    <div id="toolbar" class="btn-group">
        <div id="table-btn-list">
            <form action="" id="tb_departments_SearchTableForm">
                <div class="my-container">
                    <label class="myLabel-content">商品名称：</label>
                    <div class="myText-content">
                        <input type="text" name="a.name" class="form-control" placeholder="输入商品名称">
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">所属商品：</label>
                    <div class="myText-content">
                        <select class="form-control" name="a.category_id">
                            <option value="">全部</option>
                            <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">所属品牌：</label>
                    <div class="myText-content">
                        <select class="form-control" name="a.brand_id">
                            <option value="">全部</option>
                            <?php if(is_array($brand) || $brand instanceof \think\Collection || $brand instanceof \think\Paginator): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="my-container">
                    <label class="myLabel-content">添加时间：</label>
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
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tb_departments_Modal">添加商品</button>
                </div>
            </form>
        </div>
        <div id="table-btn-moreaction-list" style="display: none;">
            <span>您选中了 <span id="row-select-total"></span> 行 </span>
            <button type="button" class="btn btn-danger table-more-action" data-callback="merchatWithdraw" data-table="tb_departments" data-status="-1">批量删除</button>
        </div>
    </div>
    <table id="tb_departments" class="table table-hover table-striped table-extra"></table>
</div>
<div class="modal fade right" id="tb_departments_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form"  action="<?php echo url('store'); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加商品</h4>
                </div>
                <div class="modal-body">
                    <?php echo token('token_product_actions','shal'); ?>
                    <input type="hidden" name="id" value="">
                    <?php echo formInput('商品名称:','name','','text'); ?>
                    <?php echo formSelect('所属分类:','category_id',$cates,'id','name'); ?>
                    <?php echo formSelect('所属品牌:','brand_id',$brand,'id','name'); ?>
                    <?php echo formInput('店内价格:','shop_price',0); ?>
                    <?php echo formInput('市场价格:','market_price',0); ?>
                    <?php echo formInput('商品排序:','sort',0,'number'); ?>
                    <?php echo formInput('商品库存:','stock',0,'number'); ?>
                    <?php echo formFile(true,'商品图片','posters'); ?>
                    <?php echo formEditor('商品详情','details'); ?>
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
    var tableId = 'tb_departments';
    var url = "<?php echo url('dataList'); ?>";
    var delurl = "<?php echo url('delData'); ?>";
    $(function () {
        //1.初始化Table
        var fields = [
            {checkbox: true},
            {field: 'name', title: '商品名称'},
            {field: 'shop_price', title: '店内价格'},
            {field: 'market_price', title: '市场价格'},
            {field: 'stock', title: '商品库存'},
            {field: 'cate_name', title: '所属分类'},
            {field: 'brand_name', title: '所属品牌'},
            {field: 'sort', title: '商品排序', sortable: true},
            {field: 'sale_number', title: '商品销量', sortable: true},
            {field: 'create_time', title: '添加时间', sortable: true},
            {field: 'update_time', title: '更新时间', sortable: true},
            {field: '', title: '操作',formatter:function (value,row,index) {
                    return generateTableAtions(row,'id');
                }},
        ];
        var oTable = new TableInit();
        oTable.Init(tableId, url, fields, 'a.create_time', 'desc', 'searchTableForm');

        // 表单modal关闭重置表单
        $('#tb_departments_Modal').on('hide.bs.modal', function (e) {
            try{
                var obj = $(e.target);
                var formId = obj.find("form");
                $(formId).bootstrapValidator('resetForm');
                $(formId)[0].reset();
            }catch (error){

            }
        })
    });
    function generateTableAtions(row,primarykey,actions) {
        var defaultAction = [
            {'name':'编辑','class':'btn-primary row-edit','modal':"tb_departments_Modal"},
            {'name':'删除','class':'btn-danger row-delete'}
        ];
        var primarykey = primarykey ? primarykey : 'id';
        if(actions){
            if(typeof actions == 'object'){
                for(var i=0;i<actions.length;i++){
                    defaultAction.push(actions[i]);
                }
            }else{
                defaultAction.push(actions);
            }
        }
        var html = '';
        for(var i=0;i<defaultAction.length;i++){
            if(defaultAction[i].modal){
                html = html + '<button type="button" class="btn btn-sm '+defaultAction[i].class+'" data-index="'+row[primarykey]+'" data-toggle="modal" data-target="#'+defaultAction[i].modal+'">'+defaultAction[i].name+'</button>';
            }else{
                html = html + '<button type="button" class="btn btn-sm '+defaultAction[i].class+'" data-index="'+row[primarykey]+'" >'+defaultAction[i].name+'</button>';
            }
        }
        return html;
    }

    $(document).on('click','.row-edit',function (e) {
        var _this = $(e.target);
        var uniqueId = $(_this).attr("data-index");
        var table = $(_this).closest("table");
        var tableId = table.attr("id");
        var data = $('#'+tableId).bootstrapTable('getRowByUniqueId',uniqueId);
        var modalForm = $($(_this).attr("data-target")).find("form");
        renderForm(modalForm,data);
    });

    $(document).on('click','.row-delete',function (e) {
        var _this = $(e.target);
        var uniqueId = $(_this).attr("data-index");
        var table = $(_this).closest("table");
        var tableId = table.attr("id");
        bootstrapConfirm('删除商品商品','请谨慎操作','deletes($(this),'+uniqueId+',\''+delurl+'\');');
    });

    // table row action
    $(document).on('click', '.table-more-action', function (e) {
        var obj = $(e.target);
        var ids = getBtableAllselect(tableId,'id');
        bootstrapConfirm('删除商品商品','请谨慎操作','deletes($(this),\''+ids+'\',\''+delurl+'\');');
    });

    function deletes(btn,id,url) {
        pbAjax(btn,url,{id:id},function (res) {
            $("#confirm_Modal").modal('hide');
            hideLoading();
            layer.msg(res.errmsg,{icon:6});
            $("#" + tableId).bootstrapTable('refresh', {query: {}});
        })
    }


    for ( instance in CKEDITOR.instances )
    {

        CKEDITOR.instances[instance].updateElement();
    }

</script>
</body>
</html>