$(function () {
    hideLoading();
    setTimeout(function () {
        $("iframe[name='cont_box']").css("opacity", "1");
    }, 1);
    $(".top-nav li:first").trigger("click");
    box();
    $(window).resize(function () {
        box();
    });
    $("body").jrdek({Mtop: ".header", Mleft: ".main_left", Mright: ".main_right", foldCell: ".main_left h2"});
    $(".logo").click(function () {
        $("iframe[name='cont_box']").prop("src", $(this).attr('data-url'));
    });
    $("iframe[name='cont_box']").on("load", function () {
        setTimeout(function () {
            $("iframe[name='cont_box']").css("opacity", "1");
        }, 1);
    });


    // 退出登陆
    $(".logout").click(function () {
        bootstrapConfirm('信息确认', '确定退出登陆吗?', 'out();');
    });

    // 表单提交
    $(".form-ajax-submit").click(function () {
        var btn = $(this);
        var formNode = $(this).closest('form');
        if (formNode.length > 0) {
            $(formNode).bootstrapValidator({excluded: [":disabled"]});
            $(formNode).bootstrapValidator('validate');
            var flag = $(formNode).data('bootstrapValidator').isValid()//验证是否通过true/false
            if (flag) {
                // 获取表单数据
                var formData = pbFormJson($(formNode));
                // 表单地址
                var action = $(formNode).attr("action");
                // 回调函数
                var callback = $(formNode).attr("callback");
                var callback = callback ? eval(callback) : function (res) {
                    parent.layer.msg(res.errmsg, {icon: 1});
                    setTimeout(function () {
                        $('#myFormModal').modal('hide');
                        reloadIframe();
                    }, 1000)

                };
                pbAjax(btn, action, formData, callback);
            }
        }
    });


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

    // table row action
    $(document).on('click', '.table-row-action,.table-more-action', function (e) {
        var obj = $(e.target);
        var callback = eval(obj.attr("data-callback"));
        var rowData = obj.attr("data-row");
        var status = obj.attr("data-status");
        if (rowData != undefined && rowData != '') {
            var row = $.parseJSON(rowData);
        } else {
            var row = false;
        }
        var tableId = obj.attr("data-table");
        callback(row, tableId, status);
    });

    // table search
    $(".table-btn-search").click(function () {
        var tableId = $(this).attr("data-table");
        var curForm = $(this).closest('form');
        var data = pbFormJson(curForm);
        data._time = Math.random();
        showLoadding();
        $("#" + tableId).bootstrapTable('refresh', {query: data});
        hideLoading();
    });

    // table reset
    $(".table-btn-reset").click(function () {
        var tableId = $(this).attr("data-table");
        var curForm = $(this).closest('form');
        $(curForm)[0].reset();
        showLoadding();
        $("#" + tableId).bootstrapTable('refresh', {query: {}});
        hideLoading();
    });

    // 提现申请银行change事件
    $("#e78cbbe1114af26550a6322904a07657").change(function () {
        var obj = $(this);
        var curVal = obj.val();
        var form = obj.closest('form');
        if (curVal) {
            pbAjax(false, '/merchat/Account/getBankInfo', {id: curVal}, function (res) {
                renderForm(form, res.data);
                hideLoading();
            });
        } else {
            renderForm(form, {});
        }
    });
});

function renderForm(formobj, data) {
    var numtest = /^[0-9]*$/;
    for (var i = 0; i < formobj[0].length; i++) {
        if (numtest.test(i)) {
            var curElem = $(formobj[0][i]);
            var type = curElem[0].tagName;
            var name = curElem[0].name;
            // id 在下拉框用到
            var id = curElem[0].id;
            var dataName = data[name];
            switch (type) {
                case 'INPUT':
                    var iptObj = $("body").find("input[name=\'" + name + "\']");
                    var curType = iptObj.attr("type");
                    if(curType == 'radio'){
                        $(iptObj[value=dataName]).iCheck('check');
                    }else if(curType == 'checkbox'){

                    }else{
                        iptObj.val(dataName).change();
                    }
                    break;
                case 'SELECT':
                    $("#" + id).find("option[value=\'" + dataName + "\']").attr("selected","selected");
                    break;
            }
        }
    }
}

/**
 * 商户流水-行操作
 * @param row
 */
function merchatWithdraw(row, tableId, status) {
    if (row) {
        switch (row.status['value']) {
            case 0:
                bootstrapConfirm('提现记录-信息确认', '确定处理此提现记录吗?操作后不可更改,请谨慎操作', 'passMerchatWithdraw(' + row.id + ',\'' + tableId + '\');');
                break;
            case 2:
                bootstrapConfirm('提现记录-信息确认', '确定处理此提现记录吗?操作后不可更改,请谨慎操作', 'passMerchatWithdraw(' + row.id + ',\'' + tableId + '\');');
                break;
            default:
                break;
        }
    } else {
        var selectedData = getBtableAllselect(tableId, 'id');
        bootstrapConfirm('提现记录-信息确认', '确定批量处理此提现记录吗?操作后不可更改,请谨慎操作', 'passMerchatWithdraw(\'' + selectedData + '\',\'' + tableId + '\',' + status + ');');
    }
}

function passMerchatWithdraw(id, tableId, status) {
    var status = status ? status : 1;
    var url = '/merchat/Account/changeWithdrawStatus';
    pbAjax(false, url, {id: id, status: status}, function (res) {
        layer.msg(res.errmsg, {icon: 6});
        setTimeout(function () {
            if (tableId) {
                $("#" + tableId).bootstrapTable('refresh');
                $("#table-btn-list").show();
                $("#table-btn-moreaction-list").hide();
            }
            $("#confirm_Modal").modal("hide");
        }, 1000);
    });
}


/**
 * 退出登陆
 */
function out() {
    window.location.href = '/merchat/Login/logout';
}

/*
框架函数
 */
function box() {
    var bodyH = $("body").height(),
        bodyW = $("body").width(),
        boxL = parseInt($(".hello_box").css("margin-left"));
    $(".hello_order").css({"width": (parseInt(bodyW) - (boxL * 3) - 505), "height": parseInt(bodyH) - 70});
    $(".hello_opera").css({"width": "445px", "height": (parseInt(bodyH) - 210) / 3});
};

/*
重载Irame
 */
function reloadIframe() {
    parent.$("iframe[name='cont_box']").prop("src", parent.$("iframe[name='cont_box']").attr('src') + '?time_' + new Date());
    $("iframe[name='cont_box']").prop("src", $("iframe[name='cont_box']").attr('src') + '?time_' + new Date());
}

/**
 * ckedior 同步内容到texarea
 */
function sendPost() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
}


//初始化fileinput
var FileInput = function () {
    var oFile = new Object();
    //初始化fileinput控件
    oFile.Init = function (ctrlName, uploadUrl, initIMmgs, initValues) {
        var initIMmgs = initIMmgs ? initIMmgs : [];
        var initValues = initValues ? initValues : '';
        var initPreview = [];
        var block = $("#" + ctrlName + '_value').parent("div").find(".help-block");
        var bdiv = $("#" + ctrlName + '_value').parent("div").parent("div");
        for (var i = 0; i < initIMmgs.length; i++) {
            initPreview.push("<img src='" + initIMmgs[i] + "' class='file-preview-image img-responsive' style='width: 100%;height: 100%'>");
        }
        var control = $('#' + ctrlName);
        var isPath = $("#"+ctrlName).attr("data-path");
        $("#" + ctrlName + '_value').val(initValues).change();
        //初始化上传控件的样式
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: uploadUrl, //上传的地址
            allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
            showUpload: false, //是否显示上传按钮
            showCaption: false,//是否显示标题
            showPreview: false,
            browseClass: "btn btn-primary", //按钮样式
            dropZoneEnabled: false,//是否显示拖拽区域
            //minImageWidth: 50, //图片的最小宽度
            //minImageHeight: 50,//图片的最小高度
            //maxImageWidth: 200,//图片的最大宽度
            //maxImageHeight: 200,//图片的最大高度
            maxFileSize: 600,//单位为kb，如果为0表示不限制文件大小
            maxFileCount: 1, //表示允许同时上传的最大文件个数
            enctype: 'multipart/form-data',
            validateInitialCount: true,
            multiple: false,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            initialPreview: initPreview,
            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
            //向后台传递参数
            /*
            uploadExtraData:function(){
                var data={
                    apkName:'aaa',
                    versionNum:'bbb',
                    description:'ccc',
                };
                return data;
            },*/
            layoutTemplates: {
                actionDelete: '', //去除上传预览的缩略图中的删除图标
                actionUpload: '',//去除上传预览缩略图中的上传图片；
                //actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
        });
        $("#" + ctrlName).on("filebatchselected", function (event, files) {
            $("#" + ctrlName).fileinput("upload");
        });
        // 导入文件上传完成之后的事件
        $("#" + ctrlName).on("fileuploaded", function (event, data) {
            var response = data.response;
            if (response.errcode == '0') {
                var old = $("#" + ctrlName + '_value').val();
                if (old == '') {
                    var old = [];
                } else {
                    var old = old.split(',');
                }
                old.push(response.id);
                $("#" + ctrlName + '_value').val(old.join(',')).change();
            } else {
                alert(response.errmsg);
            }

        });
        // 删除事件
        $('#' + ctrlName).on('filesuccessremove', function (event, data, previewId, index) {
            $("#" + ctrlName + '_value').val('').change();
        });
        // 清空控件
        $('#' + ctrlName).on('fileclear', function (event, data, msg) {
            $("#" + ctrlName + '_value').val('').change();
        });

    }
    return oFile;
};


//初始化bootstrap table
var TableInit = function () {
    var oTableInit = new Object();
    //初始化Table
    oTableInit.Init = function (id, url, field, sort, order,shFormId) {
        var shFormId = shFormId ? shFormId : false;
        var field = field ? field : [];
        var sort = sort ? sort : '';
        var order = order ? order : '';
        $('#' + id).bootstrapTable({
            url: url,         //请求后台的URL（*）
            method: 'post',                      //请求方式（*）
            toolbar: '#toolbar',                //工具按钮用哪个容器
            striped: false,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            sortable: true,                     //是否启用排序
            sortName: sort,
            sortOrder: order,                   //排序方式
            queryParams: queryParams,//传递参数（*）
            sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 10,                       //每页的记录行数（*）
            pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
            search: false,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
            strictSearch: true,
            showColumns: true,                  //是否显示所有的列
            showRefresh: true,                  //是否显示刷新按钮
            minimumCountColumns: 2,             //最少允许的列数
            clickToSelect: false,                //是否启用点击选中行
            height: '',                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
            uniqueId: "id",                     //每一行的唯一标识，一般为主键列
            showToggle: false,                    //是否显示详细视图和列表视图的切换按钮
            cardView: false,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            columns: field,
        });

        $('#' + id).on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function (row) {
            var length = getBtableAllselect(id).length;
            handlerToobar(length);
        });
    };
    return oTableInit;
};

function queryParams(params) {
    var temp = {
        limit: params.limit,
        offset: params.offset,
        order: params.order,
        sort: params.sort,
    };
    return temp;
}

function base64Encode(input) {
    var rv;
    rv = encodeURIComponent(input);
    rv = unescape(rv);
    rv = window.btoa(rv);
    return rv;
}

function base64Decode(input) {
    rv = window.atob(input);
    rv = escape(rv);
    rv = decodeURIComponent(rv);
    return rv;
}




/**
 * 获取表格选中的数据
 * @param id
 * @returns {jQuery}
 */
function getBtableAllselect(id, ids) {
    var ids = ids ? ids : false;
    var data = $('#' + id).bootstrapTable('getAllSelections');
    if (!ids) {
        return data;
    }
    var list = [];
    for (var i = 0; i < data.length; i++) {
        list.push(data[i][ids]);
    }
    return list.join(',');
}

/**
 * 表格头事件与批量操作事件渲染
 * @param length
 */
function handlerToobar(length) {
    if (length > 0) {
        $("#table-btn-list").hide();
        $("#table-btn-moreaction-list").show();
        $("#row-select-total").text(length);
    } else {
        $("#table-btn-list").show();
        $("#table-btn-moreaction-list").hide();
    }
}

function bootstrapConfirm(title, msg, callback, tableId) {
    var confirm_html = '<div class="modal fade" id="confirm_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
         <div class="modal-dialog">\
         <div class="modal-content">\
         <div class="modal-header">\
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
     <h4 class="modal-title" id="myModalLabel">' + title + '</h4>\
     </div>\
     <div class="modal-body">' + msg + '</div>\
         <div class="modal-footer">\
         <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\
         <button type="button" class="btn btn-primary btn-confirm" onclick="' + callback + '">确认</button>\
         </div>\
         </div>\
     </div>\
     </div>';
    appendModal('confirm_Modal', confirm_html);
}



function modal_image(title, url) {
    var image_html = '<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
         <div class="modal-dialog">\
         <div class="modal-content">\
         <div class="modal-header">\
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
     <h4 class="modal-title" id="myModalLabel">' + title + '</h4>\
     </div>\
     <div class="modal-body"><img src="' + url + '" class="img-responsive"' + url + '</div>\
         </div>\
     </div>\
     </div>';
    appendModal('modalImage', image_html);
}

/**
 * append modal 并且弹出
 * @param dom
 * @param html
 */
function appendModal(dom, html) {
    var domLength = $("body").find("#" + dom).length;
    if (domLength > 0) {
        $("#" + dom).remove();
    }
    $("body").append(html);
    $("#" + dom).modal('show');
}

/**
 * 渲染ckeditor
 * @param box
 * @param content
 */
function rendorCkeditor(box, content) {
    var content = content ? content : '';
    var editor = CKEDITOR.instances[box]; //你的编辑器的"name"属性的值
    $("#" + box).val(content);
    if (editor) {
        editor.destroy(true);//销毁编辑器
    }
    CKEDITOR.replace(box); //替换编辑器，editorID为ckeditor的"id"属性的值
}


