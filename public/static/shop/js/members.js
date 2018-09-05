// +----------------------------------------------------------------------
// | IUBO    javascript
// +----------------------------------------------------------------------
// | Time  : 12:48  2018/9/4/004
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
$(function () {
    $(".shop-submit").click(function () {
        var btn = $(this);
        var formNode = $(this).closest('form');
        var formData = pbFormJson($(formNode));
        var action = $(formNode).attr("action");
        var callback = function (res) {
            layer.msg(res.errmsg, {icon: 6});
            if(res.jump){
                setTimeout(function () {
                    window.location.href = res.jump;
                },1500)
            }else{
                window.location.reload();
            }
        };
        pbAjax(btn, action, formData, callback);
    });

    $(".getEmailCode").click(function () {
        obj = $(this);
        var email = $("#email").val();
        var url = '/shop/open/email';
        pbAjax(obj,url,{email:email},function (res) {
            layer.msg(res.errmsg,{icon:6});
            obj.attr("disabled","disabled"); //将按钮置为不可点击
            obj.text(nums+'秒后可重新获取');
            clock = setInterval(doLoop, 1000); //一秒执行一次
        })
    });

    $(".shop-add-cart").click(function () {
        var obj = $(this);
        var form = obj.closest('form');
        var data = pbFormJson(form);
        pbAjax(obj,'/shop/user/insertCarts',data,function (res) {
            layer.msg(res.errmsg,{icon:6});
        })
    });

    $(".shop-buy-now").click(function () {
        var obj = $(this);
        var form = obj.closest('form');
        var data = pbFormJson(form,true);
        if(data.indexOf('product_id') === -1){
            layer.msg('请选择要结算的商品',{icon:5});
            return false;
        }
        window.location.href = '/shop/pay/check'+data;
    });
    
    $(".address-select,.paytype-select").find("td").click(function () {
        showLoadding();
        var obj = $(this);
        $(this).addClass('cursel').siblings().removeClass("cursel");
        hideLoading();
    });

    $(".shop-checkout").click(function () {
        var obj = $(this);
        var orderId = $(this).attr("data-order");
        var addrId;
        var payType;
        $(".address-select").find("td").each(function () {
            if($(this).hasClass('cursel')){
                addrId = $(this).attr("data-id");
            }
        })
        $(".paytype-select").find("td").each(function () {
            if($(this).hasClass('cursel')){
                payType = $(this).attr("data-id");
            }
        })
        if(!addrId){
            layer.msg('请选择收货地址');
            return
        }
        if(!payType){
            layer.msg('请选择支付方式');
            return
        }
        // 修改订单详情
        pbAjax(obj,'/shop/pay/detail',{orderNo:orderId,address:addrId,payType:payType},function (res) {
            // 判断支付方式
            if(payType == '1'){
                window.location.href = 'http://taobao.com';
            }else if(payType == '2'){
                window.location.href = 'http://taobao.com';
            }
        })
    });

    $(".del-address").click(function () {
        var obj = $(this);
        var id = $(this).attr("data-id");
        var url = '/shop/user/delAddr';
        layer.confirm('确认删除此收货地址吗？', {
            btn: ['删除','取消']
        }, function(){
            pbAjax(obj,url,{id:id});
        });

    });

    $(".del-carts").click(function () {
        var obj = $(this);
        var id = $(this).attr("data-id");
        var url = '/shop/user/delCarts';
        layer.confirm('确认删除购物车商品吗？', {
            btn: ['删除','取消']
        }, function(){
            pbAjax(obj,url,{id:id});
        });

    });


    $(".default-address").click(function () {
        var obj = $(this);
        var id = $(this).attr("data-id");
        var url = '/shop/user/delfaultAddr';
        layer.confirm('确认删除将此收货地址设为默认地址吗？', {
            btn: ['确定','取消']
        }, function(){
            pbAjax(obj,url,{id:id});
        });
    });

    $(".del-orders").click(function () {
        var obj = $(this);
        var id = $(this).attr("data-id");
        var url = '/shop/user/delOrders';
        layer.confirm('确认删除此订单吗？', {
            btn: ['确定','取消']
        }, function(){
            pbAjax(obj,url,{id:id});
        });
    });

    $(".orders-complete").click(function () {
        var obj = $(this);
        var id = $(this).attr("data-id");
        var url = '/shop/user/completeOrder';
        layer.confirm('确认完成此订单吗？请保证您已经收到快递', {
            btn: ['确定','取消']
        }, function(){
            pbAjax(obj,url,{id:id});
        });
    });





    $(".checkallcarts").click(function () {
        var isCheck = $(this).is(":checked");
        $(".goodsbg").each(function (index) {
            if(isCheck){
                $(this).find("input[name='product_id']").prop('checked',true);
            }else{
                $(this).find("input[name='product_id']").prop('checked',false);
            }
        });

    });



})
var obj;
var clock = '';
var nums = 120;
function doLoop()
{
    nums--;
    if(nums > 0){
        obj.text(nums+'秒后可重新获取');
        obj.attr("disabled","disabled");
    }else{
        clearInterval(clock); //清除js定时器
        obj.attr("disabled",false);
        obj.text('点击发送验证码');
        nums = 120; //重置时间
    }
}


