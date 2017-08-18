<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>登录商城</title>
    <link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
    <link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
       <script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
</head>
<body>
    <!-- 顶部导航 start -->
    <div class="topnav">
        <div class="topnav_bd w990 bc">
            <div class="topnav_left">
                
            </div>
            <div class="topnav_right fr">
                <ul>
                    <li> <?php if($_SESSION['username']== '' ): ?>[<a href="<?php echo U('User/login');?>">登录</a>]
                        [<a href="<?php echo U('User/regist');?>">免费注册</a>]
                      <?php else: ?>
                        您好 <?php echo (session('username')); ?>，欢迎来到京西！
                        [<a href="<?php echo U('User/logout');?>">退出登录</a>]<?php endif; ?> </li>
                    <li class="line">|</li>
                    <li>我的订单</li>
                    <li class="line">|</li>
                    <li>客户服务</li>

                </ul>
            </div>
        </div>
    </div>
    <!-- 顶部导航 end -->
    
    <div style="clear:both;"></div>

    <!-- 页面头部 start -->
    <div class="header w990 bc mt15">
        <div class="logo w990">
            <h2 class="fl"><a href="index.html"><img src="/Public/Home//images/logo.png" alt="京西商城"></a></h2>
            <?php if((CONTROLLER_NAME) == "Shop"): ?><div class="flow fr <?php echo (ACTION_NAME); ?>">
                <ul>
                    
                    <li <?php if((ACTION_NAME) == "viewCart"): ?>class="cur"<?php endif; ?>> 1.我的购物车</li>
                    <li <?php if((ACTION_NAME) == "goodsOrder"): ?>class="cur"<?php endif; ?>> 2.填写核对订单信息</li>
                    <li <?php if((ACTION_NAME) == "viewCart"): ?>class="cur"<?php endif; ?>> 3.成功提交订单</li>
                </ul><?php endif; ?>
        
        </div>
    </div>
    <!-- 页面头部 end -->



	<link rel="stylesheet" href="/Public/Home/style/cart.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">


	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<table>
			<thead>
				<tr>
					<th class="col1">商品名称</th>
					<th class="col2">商品信息</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody>
            <?php if(is_array($cartInfo)): foreach($cartInfo as $key=>$v): ?><tr>
					<td class="col1"><a href=""><img src="<?php echo substr($v['logo'],1);?>" alt="" /></a>  <strong><a href=""><?php echo ($v['goods_name']); ?></a></strong></td>
					<td class="col2"> <p>颜色：073深红</p> <p>尺码：170/92A/S</p> </td>
					<td class="col3">￥<span><?php echo ($v['goods_price']); ?></span></td>
					<td class="col4"> 
						<a href="javascript:;" class="reduce_num" onclick="modify_number('red',<?php echo ($v['goods_id']); ?>)"></a>
						<input type="text" name="amount" value="<?php echo ($v['goods_buy_number']); ?>" class="amount" id="goods_number_<?php echo ($v['goods_id']); ?>" onchange="modify_number('mod',<?php echo ($v['goods_id']); ?>)"/>
						<a href="javascript:;" class="add_num" onclick="modify_number('add',<?php echo ($v['goods_id']); ?>)"></a>
					</td>
					<td class="col5">￥<span id="goods_xiaoji_<?php echo ($v['goods_id']); ?>"><?php echo ($v['goods_total_price']); ?></span></td>
					<td class="col6"><a href="javascript:if(confirm('您真的要删除该商品么？')){del_goods(<?php echo ($v['goods_id']); ?>)}">删除</a></td>
				</tr><?php endforeach; endif; ?>

			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total"><?php echo ($number_price['price']); ?></span></strong></td>
				</tr>
			</tfoot>
		</table>
		<div class="cart_btn w990 bc mt10">
			<a href="<?php echo U('Home/Goods/showlist');?>" class="continue">继续购物</a>
			<a href="<?php echo U('Goods/goodsOrder');?>" class="checkout">结 算</a>
		</div>
	</div>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<script>
        //给购物车实现增，减，修改操作
        function modify_number(flag,goods_id){
            //获得当前被修改的商品数量
            var num=$('#goods_number_'+goods_id).val();
            //alert(num);
            if(flag=='red'){
                if(num==1){
                    alert('单件购买的商品数量不能少于一个，或直接删除');
                    return false;
                }
                num--
            }else if(flag=='mod'){
                var reg=/^([1-9]|1\d|20)$/;
                if(num.match(reg)==null){
                    alert('修改的数量必须是正整数，要求为1-20之间');
                    window.location.href=window.location.href;
                    return false;
                }
            }else if(flag=='add'){
                num++
                if(num>20){
                    alert('商品的最大购买数量要求为1-20之间');
                    return false;
                }
            }else{
                alert('参数不合法');
                return false;
            }
            $.ajax({
                url:'/index.php/Home/Shop/changeNumber',
                data:{goods_id:goods_id,num:num},
                type:'post',
                dataType:'json',
                success:function(msg){
                    //使得数量，小计价格，总价格得到更新
                    $('#goods_number_'+goods_id).val(num);
                    $('#goods_xiaoji_'+goods_id).html(msg.xiaoji_price);
                    $('#total').html(msg.total_price);
                }
            });

        }
        function del_goods(goods_id){
            $.ajax({
                url:'/index.php/Home/Shop/delGoods',
                type:'get',
                dataType:'json',
                data:{goods_id:goods_id},
                success:function(msg){
                    $('#goods_xiaoji_'+goods_id).parent().parent().parent().remove();
                    $('#total').html(msg.price);
                }
            });
        }

	</script>

    <!-- 底部版权 start -->
    <div class="footer w1210 bc mt15">
        <p class="links">
            <a href="">关于我们</a> |
            <a href="">联系我们</a> |
            <a href="">人才招聘</a> |
            <a href="">商家入驻</a> |
            <a href="">千寻网</a> |
            <a href="">奢侈品网</a> |
            <a href="">广告服务</a> |
            <a href="">移动终端</a> |
            <a href="">友情链接</a> |
            <a href="">销售联盟</a> |
            <a href="">京西论坛</a>
        </p>
        <p class="copyright">
             © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
        </p>
        <p class="auth">
            <a href=""><img src="/Public/Home//images/xin.png" alt="" /></a>
            <a href=""><img src="/Public/Home//images/kexin.jpg" alt="" /></a>
            <a href=""><img src="/Public/Home//images/police.jpg" alt="" /></a>
            <a href=""><img src="/Public/Home//images/beian.gif" alt="" /></a>
        </p>
    </div>
    <!-- 底部版权 end -->

</body>
</html>