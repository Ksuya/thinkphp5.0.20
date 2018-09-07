<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"E:\phpstudy2018\PHPTutorial\WWW\newtp\public/../application/manager\view\shop\order\detail.html";i:1536299806;}*/ ?>
<style>
    .list-group .span{font-weight: bolder;}
</style>
<div class="panel panel-success">
    <div class="panel-heading">
        基本信息
    </div>
    <ul class="list-group">
        <li class="list-group-item">订单编号: <span><?php echo $detail['order_no']; ?></span></li>
        <li class="list-group-item">购买用户: <span><?php echo $detail['user_name']; ?></span></li>
        <li class="list-group-item">订单金额: <span><?php echo $detail['order_amount']; ?></span></li>
        <li class="list-group-item">支付方式: <span><?php echo $detail['pay_type']['name']; ?></span></li>
        <li class="list-group-item">订单状态: <span><?php echo $detail['status']['name']; ?></span></li>
        <li class="list-group-item">物流状态: <span><?php echo $detail['progress']['name']; ?></span></li>
        <li class="list-group-item">下单时间: <span><?php echo $detail['create_time']; ?></span></li>
    </ul>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        收货信息
    </div>
    <ul class="list-group">
        <li class="list-group-item">收货人: <span><?php echo $detail['reciver']; ?></span></li>
        <li class="list-group-item">联系电话: <span><?php echo $detail['contact']; ?></span></li>
        <li class="list-group-item">所在地区: <span><?php echo $detail['region']; ?></span></li>
        <li class="list-group-item">详细地址: <span><?php echo $detail['address']; ?></span></li>
    </ul>
</div>

<?php if($detail['progress']['id'] > 1): ?>
<div class="panel panel-primary">
    <div class="panel-heading">物流信息</div>
    <table class="table">
        <th>时间</th><th>追踪 </th>
        <?php foreach($detail['route'] as $k=>$v): ?>
        <tr><td><?php echo $v['time']; ?></td><td><?php echo $v['context']; ?></td></tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
<div class="panel panel-info">
    <div class="panel-heading">商品信息</div>
    <table class="table">
        <th>图片</th><th>商品</th><th>价格 </th><th>市场价 </th><th>购买数量 </th>
        <?php foreach($detail['products'] as $k=>$v): ?>
        <tr><td><img src="<?php echo $v['path']; ?>" class="img-responsive" alt=""></td><td><?php echo $v['name']; ?></td><td><?php echo $v['shop_price']; ?></td><td><?php echo $v['market_price']; ?></td><td><?php echo $v['number']; ?></td></tr>
        <?php endforeach; ?>
    </table>
</div>