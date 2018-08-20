
 /*
|--------------------------------------------------------------------------
| Author:whlphper 2018/8/19 14:02
|--------------------------------------------------------------------------
| Description:
|
*/
 /**
  * 加载层
  */
 function showLoadding() {
     layer.load(2, {
         shade: [0.1,'#fff'] //0.1透明度的白色背景
     });
 }

 /**
  * 关闭加载层
  */
 function hideLoading() {
     layer.closeAll('loading');
     parent.layer.closeAll('loading');
 }


 function pbAjax(btnDom, url, data, callback, method, responseType) {
     var timestamp=new Date().getTime();
     var method = method ? method : 'POST';
     var responseType = responseType ? responseType : 'JSON';
     var callback = callback ? callback : function (res) {
         showLoadding();
         window.location.reload();
     };
     // 发送ajax
     $.ajax({
         url: url+'?_time='+timestamp,    //请求的url地址
         dataType: responseType,   //返回格式为json
         //contentType:"text/json;charset=UTF-8", //也就是 request payload
         async: true,//请求是否异步，默认为异步，这也是ajax重要特性
         data: data,    //参数值
         type: method,   //请求方式
         headers : {'ApiToken':"mytoken"},
         beforeSend: function () {
             //请求前的处理
             // 禁用按钮
             if (btnDom) {
                 btnDom.attr("disabled", "disabled");
             }
             showLoadding();
         },
         success: function (response) {
             if (responseType == 'html') {
                 callback(response);
                 return;
             }
             //请求成功时处理
             switch (response["errcode"]) {
                 // 请求成功
                 case '0':
                     callback(response);
                     parent.layer.closeAll("loading");
                     break;
                 // 没有权限
                 case '111':
                     if (response.errmsg != '' && response.errmsg != undefined) {
                         parent.layer.msg(response.errmsg, {icon: 0});
                     }
                     break;
                 default:
                     hideLoading();
                     if (response.errmsg != '' && response.errmsg != undefined) {
                         if(response.errmsg === 'invalid token'){
                             setTimeout(function () {
                                 freshIframe();
                                 window.location.reload();
                             },100);
                         }else{
                             parent.layer.msg(response.errmsg, {icon: 0});
                         }
                     }
                     break;
             }
         },
         complete: function () {
             //请求完成的处理
             if (btnDom) {
                 btnDom.removeAttr("disabled");
             }
         },
         error: function () {
             parent.layer.closeAll("loading");
             //请求出错处理
             parent.layer.msg('404 not found', {icon: 0});
         }
     });
 }


 // 获取表单JSON数据,结合validate检查,return true/false
 function pbFormJson(formId, isGET) {
     var fType = typeof(formId);
     if (fType != 'object') {
         // 搜索参数搜集
         var formData = $("#" + formId).serializeArray();
     } else {
         var formData = formId.serializeArray();
     }
     var isGET = isGET ? true : false;

     if (isGET) {
         var param = '';
         $.each(formData, function () {
             if (this.value != '') {
                 if (param == '') {
                     param = '?' + this.name + '=' + this.value;
                 } else {
                     param = param + '&' + this.name + '=' + this.value;
                 }
             }
         });
         return param;
     } else {
         var o = {};
         $.each(formData, function () {
             if (o[this.name]) {
                 if (!o[this.name].push) {
                     o[this.name] = [o[this.name]];
                 }
                 o[this.name].push(this.value || '');
             } else {
                 if (this.value && this.value != '') {
                     o[this.name] = this.value || '';
                 }
             }
         });
         for (tmp in o) {
             if ($.isArray(o[tmp])) {
                 o[tmp] = o[tmp].join(",");
             }
         }
         return o;
     }
 }




 /**
  * onchange上传图片
  * @param obj
  */
 function reayUpload(obj) {
     //演示上传文件
     var id = obj.attr("data-id");
     var url = obj.attr("data-url");
     var preview = obj.attr("data-preview");
     var curObject = obj;
     ajaxUpload(curObject, id, url, preview);
 }

 /**
  * 上传图片
  * curObject   点击自身DOM
  * id          存放图片地址的 DOM ID
  * url         后端上传地址
  * preview     存放预览图片的 DOM ID
  */
 function ajaxUpload(curObject, id, url, preview) {
     var preview = preview ? preview : false;
     var isMultyple = curObject.attr("multiple") ? true : false;
     var floder = curObject.attr('data-dir') ? curObject.attr('data-dir') : 'default';
     var size = curObject.attr('data-size') ? curObject.attr('data-size') : '2';
     var thumb = curObject.attr('data-thumb') ? curObject.attr('data-thumb') : '';
     var path = curObject.attr('data-type') ? curObject.attr('data-type') : false;
     var icon = curObject.attr('data-icon') ? curObject.attr('data-icon') : '';
     console.log(icon)
     return
     var curObject = curObject;
     //获取上传所有文件信息
     var files = curObject.get(0).files;
     //多文件上传
     for (var i = 0; i < files.length; i++) {
         var obj = files[i];
         //装需要上传文件的数组
         data = new FormData();
         data.append("file", obj);
         data.append("floder", floder);
         data.append("size", size);
         data.append("thumb", thumb);
         data.append("icon", icon);
         $.ajax({
             data: data,
             type: "POST",
             url: url,
             cache: false,
             contentType: false,
             processData: false,
             success: function (res) {
                 if (isMultyple) {
                     var curVal = $("#" + id).val();
                     if (curVal == '') {
                         var lastVal = new Array();
                     } else {
                         var lastVal = curVal.split(",");
                     }

                     lastVal.push(res.data);
                     lastVal = lastVal.join(',');
                     $("#" + id).val(lastVal);
                 } else {
                     if(path && path =='path'){
                         $("#" + id).val(res.path);
                     }else{
                         $("#" + id).val(res.data);
                     }
                 }
                 if (preview) {
                     parent.layer.msg("文件上传成功", {icon: 1});
                     preview = preview.replace(/\s/g, "");
                     if (isMultyple) {
                         var html = '<div class="file-upload">\
                            <img id="' + res.data + '" src="' + res.path + '" />\
                            <span class="upload-close" onclick="removePreview($(this),' + res.data + ',\'' + id + '\');"></span>\
                            </div>';
                         //var html = '<div class="img col-lg-3"><img class="img-responsive" id="' + res.data + '" src="'+res.path+'"> <span class="close" onclick="removePreview($(this),'+res.data+',\''+id+'\');"><i class="fa fa-remove"></i>删除</span></div>';
                         $(curObject).parent().append(html);
                     } else {
                         var html = '<div class="file-upload">\
                            <img id="' + res.data + '" src="' + res.path + '" />\
                            <span class="upload-close" onclick="removePreview($(this),' + res.data + ',\'' + id + '\');"></span>\
                            </div>';
                         $("#" + preview).html(html)
                     }
                 }
             },
             error: function (res) {
                 parent.layer.msg("404 not found", {icon: 2});
             }
         }, 'JSON');
     }
 }

 /**
  * 删除上传后的图片
  * obj     span自身
  * imgId   img对应的ID
  * valueId 存放图片地址的Id
  * 单图片/多图片均可用
  */
 function removePreview(obj, imgId, valueId) {
     var curpath = $("#" + imgId).attr("id");
     obj.remove();
     $("#" + imgId).remove();
     if (obj.parent('div').hasClass('img')) {
         obj.parent('div').remove();
     }
     var oldVal = $("#" + valueId).val();
     oldVal = oldVal.split(",");
     var newVal = new Array();
     for (var i = 0; i < oldVal.length; i++) {
         if (oldVal[i] != curpath) {
             newVal.push(oldVal[i]);
         }
     }
     newVal.join(",");
     $("#" + valueId).val(newVal);
 }


 /*
  * 获取BootstrapeTable选中行
  * @param  tableId  表格ID
  * @return 选中的ID数组
  */
 function mdGetTableChecked(tableID) {
     var checkArr = $("#" + tableID).bootstrapTable('getSelections');
     if (checkArr.length == 0) {
         return false;
     }
     var idStr = new Array();
     for (i = 0; i < checkArr.length; i++) {
         idStr.push(checkArr[i].id);
     }
     return idStr;
 }


 function jsonToArr(jsonStr) {
     var jsonObj = JSON.parse(jsonStr);
     var jsonArr = [];
     for (var i = 0; i < jsonObj.length; i++) {
         jsonArr[i] = jsonObj[i];
     }
     return jsonArr;
 }


 /*
  ** randomWord 产生任意长度随机字母数字组合
  ** randomFlag-是否任意长度 min-任意长度最小位[固定位数] max-任意长度最大位
  ** xuanfeng 2014-08-28
  */

 function randomWord(randomFlag, min, max) {
     var str = "",
         range = min,
         arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

     // 随机产生
     if (randomFlag) {
         range = Math.round(Math.random() * (max - min)) + min;
     }
     for (var i = 0; i < range; i++) {
         pos = Math.round(Math.random() * (arr.length - 1));
         str += arr[pos];
     }
     return str;
 }


 /**
  * 预览图片
  * @param obj
  */
 function showImage(obj) {
     var id = obj.attr("data-id");
     var url = obj.attr("data-url");
     var data = {};
     data.id = id;
     pbAjax(obj,url,data,function (res) {
         var html = '<img style="width:80%;height:80%;" src="'+res.image+'">';
         //页面层
         layer.open({
             title:'Preview',
             type: 1,
             skin: 'layui-layer-rim', //加上边框
             area: ['420px', '240px'], //宽高
             shade:0.1,
             shadeClose: true,
             content: html
         });
     });
 }
 
 function bootstrapConfirm(title,msg,callback) {
     var confirm_html = '<div class="modal fade" id="confirm_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
         <div class="modal-dialog">\
         <div class="modal-content">\
         <div class="modal-header">\
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
     <h4 class="modal-title" id="myModalLabel">'+title+'</h4>\
     </div>\
     <div class="modal-body">'+msg+'</div>\
         <div class="modal-footer">\
         <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\
         <button type="button" class="btn btn-primary btn-confirm" callback="'+callback+'">确认</button>\
         </div>\
         </div>\
     </div>\
     </div>';
     appendModal('confirm_Modal',confirm_html);
 }

 $(document).on('click','.btn-confirm',function (e) {
     var obj = $(e.target);
     var callback = obj.attr("callback");
     var func = eval(callback);
     func();
 });

 function appendModal(dom,html) {
     var domLength = $("body").find("#"+dom).length;
     if(domLength > 0){
         $("#"+dom).remove();
     }
     $("body").append(html);
     $("#"+dom).modal('show');
 }

 /**
  * 渲染ckeditor
  * @param box
  * @param content
  */
 function rendorCkeditor(box,content)
 {
     var content = content ? content : '';
     var editor = CKEDITOR.instances[box]; //你的编辑器的"name"属性的值
     $("#"+box).val(content);
     if (editor) {
         editor.destroy(true);//销毁编辑器
     }
     CKEDITOR.replace('detail'); //替换编辑器，editorID为ckeditor的"id"属性的值
 }