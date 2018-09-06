$(function () {
    //1.初始化Table
    var oTable = new TableInit();
    if(tableId){
        oTable.Init(tableId, url, fields, sortName, sortOrder);

    }

    // 表单modal关闭重置表单
    $('#tb_departments_Modal').on('hide.bs.modal', function (e) {
        try{
            var obj = $(e.target);
            var formId = obj.find("form");
            $(formId).bootstrapValidator('resetForm');
            //$(formId)[0].reset();
        }catch (error){

        }
    })





    // checkbox  radio
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
    });

    // datepicker
    $('.datepicker').datepicker({
        "autoclose": true, "format": "yyyy-mm-dd", "language": "zh-CN"
    });

    // ckeditor 冲突
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
        modal_this = this
        $(document).on('focusin.modal', function (e) {
            if (modal_this.$element[0] !== e.target
                && !modal_this.$element.has(e.target).length
                && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select')
                && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                modal_this.$element.focus()
            }
        })
    };

    // bootstrap select
    $('.selectpicker').selectpicker({
        style: '',
        size: 4
    });


    // table search
    $(".table-btn-search").click(function (href) {
        var tableId = $(this).attr("data-table");
        var curForm = $(this).closest('form');
        var data = pbFormJson(curForm,true);
        data._time = Math.random();
        showLoadding();
        $("#"+tableId).bootstrapTable('refresh',data);
        hideLoading();
    });

    // table reset
    $(".table-btn-reset").click(function () {
        var tableId = $(this).attr("data-table");
        var curForm = $(this).closest('form');
        $(curForm)[0].reset();
        showLoadding();
        $("#"+tableId).bootstrapTable('refresh',{});
        hideLoading();
    });
});
function generateTableAtions(row,primarykey,actions) {
    var defaultAction = [
        {'name':'编辑','class':'btn-primary row-edit','modal':formModal},
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
    bootstrapConfirm('删除','请谨慎操作','deletes($(this),'+uniqueId+',\''+delurl+'\');');
});

// table row action
$(document).on('click', '.table-more-action', function (e) {
    var obj = $(e.target);
    var ids = getBtableAllselect(tableId,'id');
    bootstrapConfirm('删除','请谨慎操作','deletes($(this),\''+ids+'\',\''+delurl+'\');');
});

function deletes(btn,id,url) {
    pbAjax(btn,url,{id:id},function (res) {
        $("#confirm_Modal").modal('hide');
        hideLoading();
        layer.msg(res.errmsg,{icon:6});
        $("#" + tableId).bootstrapTable('refresh', {query: {}});
    })
}

function queryParams(params) {
    var data = pbFormJson('tb_departments_SearchTableForm');
    data.limit = params.limit;
    data.offset =  params.offset;
    data.order = params.order;
    data.sort = params.sort;
    return data;
}
