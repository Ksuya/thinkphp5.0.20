<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:99:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\public/../application/merchat\view\account\info.html";i:1534732855;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-header.html";i:1534684867;s:95:"E:\phpstudy2018\PHPTutorial\WWW\payment-system\application\common\view\public\admin-script.html";i:1534688156;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商户后台管理</title>
    <link type="text/css" rel="stylesheet" href="/static/js/vendor/bootstrap/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="/static/fontsawesome/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="/static/css/style.css"/>
    <link rel="stylesheet" href="/static/js/vendor/bootstrap-validate/css/bootstrapValidator.css">
    <link rel="stylesheet" href="/static/js/vendor/icheck/skins/flat/green.css">
</head>
<body>

<body class="in-frame">
<div class="row">
    <ol class="breadcrumb">
        <li><a>首页</a></li>
        <li><a>账户管理</a></li>
        <li class="active">账户信息</li>
    </ol>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#base" data-toggle="tab">基本信息</a>
        </li>
        <li><a href="#detail" data-toggle="tab">详细信息</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="base">
            <div class="panel panel-default" style="margin-top:30px;">
                <ul class="list-group">
                    <li class="list-group-item">商户名称：<?php echo $base['name']; ?></li>
                    <li class="list-group-item">商户编号：<?php echo $base['sign_number']; ?></li>
                    <li class="list-group-item">商户余额：<?php echo (isset($base['balance']) && ($base['balance'] !== '')?$base['balance']:0); ?></li>
                    <li class="list-group-item">保&nbsp;证&nbsp;&nbsp;金：<?php echo (isset($base['bond']) && ($base['bond'] !== '')?$base['bond']:0); ?></li>
                    <li class="list-group-item">时用状态：<?php echo $base['status']; ?></li>
                    <li class="list-group-item">联系邮箱：<?php echo (isset($base['email']) && ($base['email'] !== '')?$base['email']:''); ?></li>
                    <li class="list-group-item">开通时间：<?php echo (isset($base['created_time']) && ($base['created_time'] !== '')?$base['created_time']:''); ?></li>
                </ul>

            </div>
        </div>
        <div class="tab-pane fade" id="detail">
            <div class="panel panel-default" style="margin-top:30px;">
                <div class="panel-heading">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#merchatDetail">修改信息
                    </button>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">真实姓名：<?php echo $detail['real_name']; ?></li>
                    <li class="list-group-item">身份证号：<?php echo $detail['id_number']; ?></li>
                    <li class="list-group-item">公司地址：<?php echo $detail['region']; ?></li>
                    <li class="list-group-item">详细地址：<?php echo $detail['address']; ?></li>
                    <li class="list-group-item">营业执照：<?php echo $detail['business']; ?></li>
                    <li class="list-group-item">法人姓名：<?php echo $detail['legal_name']; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="merchatDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form class="form-horizontal" role="form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">修改详细信息</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">必填</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control " id="firstname" name="username" required
                                       data-bv-notempty-message="XXX不能为空" placeholder="请输入名字">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">必填+长度</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="lastname" name="ddsdsds" required
                                       data-bv-notempty-message="XXX不dsdsds能为空" data-bv-stringlength="true"
                                       data-bv-stringlength-min="6" data-bv-stringlength-max="30"
                                       data-bv-stringlength-message="这个字段长度不得小于6，不得超过30 " placeholder="请输入姓">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">必填+两次一致</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ddsdsds22" required
                                       data-bv-notempty-message="必填+大小值不dsdsds能为空" data-bv-identical="true"
                                       data-bv-identical-field="username" data-bv-identical-message="这个字段比一样"
                                       placeholder="请输入姓">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="ssssss" required
                                       data-bv-notempty-message="XXX不dsdsds能为空"
                                       data-bv-emailaddress-message="The input is not a valid email address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">日期</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="454212" required
                                       data-bv-notempty-message="XXX不dsdsds能为空" data-bv-date="true"
                                       data-bv-date-format="YYYY/MM/DD"
                                       data-bv-date-message="The birthday is not valid">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">数字</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required data-bv-notempty-message="数字不能为空"
                                       name="45421245454" data-bv-digits="true" data-bv-digits-message="its digits">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">金额</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required data-bv-notempty-message="金额不能为空"
                                       name="454212454545555" data-bv-decimal="true" data-bv-decimal-message="输入正确金额">
                            </div>
                        </div>
                        <div class="form-group" id="company_region">
                            <label class="col-sm-2 control-label">公司省市</label>
                            <div class="col-sm-10 cxselect-list">
                                <select class="province form-control" name="region" data-value="浙江省"
                                        data-first-title="选择省" disabled="disabled" required
                                        data-required-msg="选择省"></select>
                                <select class="city form-control" name="region" data-value="杭州市" data-first-title="选择市"
                                        disabled="disabled" required data-required-msg="选择市"></select>
                                <select class="area form-control" name="region" data-value="西湖区" data-first-title="选择地区"
                                        disabled="disabled" required data-required-msg="选择地区"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">单选框</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosinline" required id="optionsRadios4"
                                           value="option2" checked="checked">选项 2
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadiosinline" required id="optionsRadios5"
                                           value="option2">选项 2
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">复选框</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="checkbox" name="diosinline" data-bv-choice="true"
                                           data-bv-choice-min="1" data-bv-choice-max="3"
                                           data-bv-choice-field="diosinline" data-bv-choice-message="checkbox1-3"
                                           value="option2" checked="checked">选项 2
                                </label>
                                <label class="radio-inline">
                                    <input type="checkbox" name="diosinline" data-bv-choice="true"
                                           data-bv-choice-min="1" data-bv-choice-max="3"
                                           data-bv-choice-field="diosinline" data-bv-choice-message="checkbox1-3"
                                           value="option25">选项 2
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">多选下拉框</label>
                            <div class="col-sm-10">
                                <select class=" form-control" name="favor" multiple="multiple" data-bv-choice="true"
                                        data-bv-choice-min="1" data-bv-choice-max="3" data-bv-choice-field="favor"
                                        data-bv-choice-message="1-3ge">
                                    <option>请选择</option>
                                    <option value="dsds">111</option>
                                    <option value="dsds45">222</option>
                                    <option value="333">333</option>
                                    <option value="444">444</option>
                                    <option value="555">555</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">下拉框</label>
                            <div class="col-sm-10">
                                <select class=" form-control" name="favor2" required data-bv-notempty-message="下拉框1">
                                    <option value="">请选择</option>
                                    <option value="dsds">111</option>
                                    <option value="dsds45">222</option>
                                    <option value="333">333</option>
                                    <option value="444">444</option>
                                    <option value="555">555</option>
                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">ckeditor</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="editor1"></textarea>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 100px;">
                            <label class="col-sm-2 control-label">datepicker</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control datepicker"  />
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
</div>
<!--javascript include-->
<script src="/static/js/jquery-2.2.1.min.js"></script>
<script src="/static/js/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/static/js/vendor/layer/layer.js"></script>
<script src="/static/js/vendor/bootstrap-validate/js/bootstrapValidator.js"></script>
<script src="/static/js/vendor/bootstrap-validate/js/language/zh_CN.js"></script>
<script src="/static/js/vendor/cxselect/jquery.cxselect.min.js"></script>
<script src="/static/js/vendor/icheck/icheck.min.js"></script>
<script src="/static/js/tipSuppliers.js"></script>
<script src="/static/system/core.js"></script>
<script src="/static/system/vendor.js"></script>
<script type="text/javascript" src="/static/js/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/static/js/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/static/js/vendor/datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<link rel="stylesheet" href="/static/js/vendor/datepicker/css/bootstrap-datepicker.min.css">
<script>
    $(function () {
        //$('#myTab li:eq(0) a').tab('show');
        $.cxSelect.defaults.url = '/static/js/vendor/cxselect/cityData.min.json';
        $('#company_region').cxSelect({
            selects: ['province', 'city', 'area'],
            nodata: 'none'
        });
        // ckeditor 冲突

        /*var $modalElement = this.$element;
        $(document).on('focusin.modal', function (e) {
            var $parent = $(e.target.parentNode);
            if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length && !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
                $modalElement.focus()
            }
        })*/
        CKEDITOR.replace('editor1',{
            filebrowserImageUploadUrl : '<?php echo url("Login/ajaxUpload"); ?>',
            language : 'zh-cn',
        });

        // datepicker
        $('.datepicker').datepicker({
            "autoclose":true,"format":"yyyy-mm-dd","language":"zh-CN"
        });
    });
</script>
</body>
</html>