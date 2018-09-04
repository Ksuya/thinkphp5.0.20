$(function () {
    //1.初始化Table
    var oTable = new TableInit();
    oTable.Init(tableId, url, fields, sortName, sortOrder);
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
