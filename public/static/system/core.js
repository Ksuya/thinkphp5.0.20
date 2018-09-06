
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
     parent.layer.load(3, {
         shade: [0.3,'#fff'] //0.1透明度的白色背景
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
     var method = method ? method : 'post';
     var responseType = responseType ? responseType : 'json';
     var callback = callback ? callback : function (res) {
         showLoadding();
         window.location.reload();
     };
     // 发送ajax
     $.ajax({
         url: url+'?_time='+timestamp,    //请求的url地址
         dataType: responseType,   //返回格式为json
         contentType:"application/json; charset=utf-8", //也就是 request payload
         async: true,//请求是否异步，默认为异步，这也是ajax重要特性
         data: JSON.stringify(data),    //参数值
         type: method,   //请求方式
         headers : {'ApiToken':$("#apitoken").val()},
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
                     hideLoading();
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
             parent.layer.closeAll("loading");
         },
         error: function () {
             //请求出错处理
             parent.layer.msg('404 not found', {icon: 0});
             hideLoading();
         }
     });
 }

 function getQueryVariable(variable)
 {
     var query = window.location.search.substring(1);
     var vars = query.split("&");
     for (var i=0;i<vars.length;i++) {
         var pair = vars[i].split("=");
         if(pair[0] == variable){return pair[1];}
     }
     return(false);
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
     if (isGET) {
         var params = '';
         for (tmp in o) {
             if(params == '')
             {
                 params = '?' + params + tmp + '=' + o[tmp];
             }else{
                 params = params + '&' + tmp + '=' + o[tmp];
             }
         }
         return params;
     } else {
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
     var limit = curObject.attr("data-limit") ? curObject.attr("data-limit") : 1;
     var path = curObject.attr("data-path") ? curObject.attr("data-path") : false;
     var curObject = curObject;
     //获取上传所有文件信息
     var files = curObject.get(0).files;
     //多文件上传
     for (var i = 0; i < files.length; i++) {
         var obj = files[i];
         //装需要上传文件的数组
         data = new FormData();
         data.append("file", obj);
         $.ajax({
             data: data,
             type: "POST",
             url: url,
             cache: false,
             contentType: false,
             processData: false,
             success: function (res) {
                 if(res.errcode != '0'){
                     layer.msg(res.errmsg,{icon:5});
                     return;
                 }
                 if (limit > 1) {
                     var curVal = $("#" + id).val();
                     if (curVal == '') {
                         var lastVal = new Array();
                     } else {
                         var lastVal = curVal.split(",");
                         if(lastVal.length >= limit){
                             layer.msg("最多可以上传"+limit+'张图片',{icon:5});
                             return false;
                         }
                     }
                     lastVal.push(res.id);
                     lastVal = lastVal.join(',');
                     $("#" + id).val(lastVal).change();
                 } else {
                     if(path && path == 'path'){
                         $("#" + id).val(res.path).change();
                     }else{
                         $("#" + id).val(res.id).change();
                     }
                 }
                 if (preview) {
                     layer.msg(res.errmsg, {icon: 6});
                     preview = preview.replace(/\s/g, "");
                     if (limit > 1) {
                         var html = '<div class="col-sm-3"><img id="'+res.id+'" src="'+res.path+'" class="img-responsive"><span title="删除图片" class="remove-file" onclick="removePreview($(this),' + res.id + ',\'' + id + '\');">x</span></div>';
                         $("#" + preview).append(html);
                     } else {
                         var html = '<div class="col-sm-3"><img id="'+res.id+'" src="'+res.path+'" class="img-responsive"><span title="删除图片" class="remove-file" onclick="removePreview($(this),' + res.id + ',\'' + id + '\');">x</span></div>';
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
     $("#" + valueId).val(newVal).change();
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
 


