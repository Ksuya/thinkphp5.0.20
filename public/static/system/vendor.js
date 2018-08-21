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
        bootstrapConfirm('信息确认', '确定退出登陆吗?', 'out');
    });

    // 表单提交
    $(".form-ajax-submit").click(function () {
        var btn = $(this);
        var formNode = $(this).closest('form');
        if (formNode.length > 0) {
            $(formNode).bootstrapValidator({ excluded:[":disabled"]});
            $(formNode).bootstrapValidator('validate');
            var flag = $(formNode).data('bootstrapValidator').isValid()//验证是否通过true/false
            if(flag){
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
                    },1000)

                };
                pbAjax(btn, action, formData, callback);
            }
        }
    });

    // 表单modal关闭重置表单
    $('#myFormModal').on('hide.bs.modal',function(e) {
        var obj = $(e.target);
        var formId = obj.find("form");
        $(formId).bootstrapValidator('resetForm');
        $(formId)[0].reset();
        //reloadIframe();
    })

    // checkbox  radio
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green',
    });

    // datepicker
    $('.datepicker').datepicker({
        "autoclose":true,"format":"yyyy-mm-dd","language":"zh-CN"
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
});


// filkeinput
//初始化fileinput
var FileInput = function () {
    var oFile = new Object();
    //初始化fileinput控件
    oFile.Init = function(ctrlName, uploadUrl,initIMmgs,initValues) {
        var initIMmgs = initIMmgs ? initIMmgs : [];
        var initValues = initValues ? initValues : '';
        var initPreview = [];
        var block = $("#"+ctrlName+'_value').parent("div").find(".help-block");
        var bdiv = $("#"+ctrlName+'_value').parent("div").parent("div");
        for(var i=0;i<initIMmgs.length;i++){
            initPreview.push("<img src='"+initIMmgs[i]+"' class='file-preview-image img-responsive' style='width: 100%;height: 100%'>" );
        }
        var control = $('#' + ctrlName);
        $("#"+ctrlName+'_value').val(initValues).change();
        //初始化上传控件的样式
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: uploadUrl, //上传的地址
            allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
            showUpload: true, //是否显示上传按钮
            showCaption: false,//是否显示标题
            browseClass: "btn btn-primary", //按钮样式
            dropZoneEnabled: false,//是否显示拖拽区域
            //minImageWidth: 50, //图片的最小宽度
            //minImageHeight: 50,//图片的最小高度
            //maxImageWidth: 200,//图片的最大宽度
            //maxImageHeight: 200,//图片的最大高度
            maxFileSize: 600,//单位为kb，如果为0表示不限制文件大小
            maxFileCount: 1, //表示允许同时上传的最大文件个数
            enctype: 'multipart/form-data',
            validateInitialCount:true,
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
            layoutTemplates :{
                actionDelete:'', //去除上传预览的缩略图中的删除图标
                actionUpload:'',//去除上传预览缩略图中的上传图片；
                //actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
        });
        // 导入文件上传完成之后的事件
        $("#"+ctrlName).on("fileuploaded", function (event, data) {
            var response = data.response;
            if(response.errcode == '0'){
                var old = $("#"+ctrlName+'_value').val();
                if(old == ''){
                    var old = [];
                }else{
                    var old = old.split(',');
                }
                old.push(response.path);
                $("#"+ctrlName+'_value').val(old.join(',')).change();
            }else{
                alert(response.errmsg);
            }

        });
        // 删除事件
        $('#'+ctrlName).on('filesuccessremove', function(event, data, previewId, index) {
            $("#"+ctrlName+'_value').val('').change();
        });
        // 清空控件
        $('#'+ctrlName).on('fileclear', function(event, data, msg) {
            $("#"+ctrlName+'_value').val('').change();
        });

    }
    return oFile;
};



/**
 * 退出登陆
 */
function out() {
    window.location.href = '/merchat/Login/logout';
}

function box() {
    var bodyH = $("body").height(),
        bodyW = $("body").width(),
        boxL = parseInt($(".hello_box").css("margin-left"));
    $(".hello_order").css({"width": (parseInt(bodyW) - (boxL * 3) - 505), "height": parseInt(bodyH) - 70});
    $(".hello_opera").css({"width": "445px", "height": (parseInt(bodyH) - 210) / 3});
};

function reloadIframe() {
    parent.$("iframe[name='cont_box']").prop("src", parent.$("iframe[name='cont_box']").attr('src')+'?time_'+new Date());
    $("iframe[name='cont_box']").prop("src", $("iframe[name='cont_box']").attr('src')+'?time_'+new Date());
}

/**
 * ckedior 同步内容到texarea
 */
function sendPost() {
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
}