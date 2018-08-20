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
            $(formNode).bootstrapValidator('validate', {
            }).on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();
                // Get the form instance
                var $form = $(e.target);
                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');
                // Use Ajax to submit form data
                // 获取表单数据
                var formData = pbFormJson($(formNode));
                console.log(formData)
                return
                // 表单地址
                var action = $(formNode).attr("action");
                // 回调函数
                var callback = $(formNode).attr("callback");
                var callback = callback ? eval(callback) : function (res) {
                    parent.layer.msg(res.errmsg, {icon: 1});
                    console.log(res)
                };
                pbAjax(btn, action, formData, callback);
            });


        }
    });

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
    $("iframe[name='cont_box']").prop("src", $("iframe[name='cont_box']").attr('src'));
}

