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



	<link rel="stylesheet" href="/Public/Home/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">


	<script type="text/javascript" src="/Public/Home/js/cart2.js"></script>


	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<form action="" method="post">
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>


				<div class="address_select">
					<ul>
						<?php if(is_array($address)): foreach($address as $key=>$v): ?><li class="cur">
							<input type="radio" name="cgn_id" checked="checked" value="<?php echo ($v['cgn_id']); ?>"/><?php echo ($v['cgn_name']); ?> <?php echo ($v['cgn_address']); ?> <?php echo ($v['cgn_tel']); ?>
							<a href="">设为默认地址</a>
							<a href="">编辑</a>
							<a href="">删除</a>
						</li><?php endforeach; endif; ?>
						<li><input type="radio" name="address" class="new_address"  />使用新地址</li>
					</ul>
				</div>
			</div>
			<!-- 收货人信息  end-->



			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>

				<div class="pay_select">
					<table> 
						<tr class="cur">
							<td class="col1"><input type="radio" name="order_pay" value="0" checked="checked"/>支付宝</td>
						</tr>
						<tr>
							<td class="col1"><input type="radio" name="order_pay" value="1"/>微信</td>
						</tr>
						<tr>
							<td class="col1"><input type="radio" name="order_pay" value="2"/>银行卡</td>
						</tr>
					</table>
				</div>
			</div>
			<!-- 支付方式  end-->

			<!-- 发票信息 start-->
			<div class="receipt">
				<h3>发票信息 <a href="javascript:;" id="receipt_modify">[修改]</a></h3>
				<div class="receipt_info">
					<p>个人发票</p>
					<p>内容：明细</p>
				</div>

				<div class="receipt_select>
						<ul>
							<li>
								<label for="">发票抬头：</label>
								<input type="radio" name="order_fapiao_title" checked="checked" class="personal" value="0"/>个人
								<input type="radio" name="order_fapiao_title" class="company" value="1"/>单位
								<input type="text" class="txt company_input" name="order_fapiao_company" />
							</li>
							<li>
								<label for="">发票内容：</label>
								<input type="radio" name="order_fapiao_content" checked="checked" value="明细"/>明细
								<input type="radio" name="order_fapiao_content" value="办公用品"/>办公用品
								<input type="radio" name="order_fapiao_content" value="体育休闲"/>体育休闲
								<input type="radio" name="order_fapiao_content" value="耗材"/>耗材
							</li>
						</ul>

				</div>
			</div>
			<!-- 发票信息 end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>
					<?php if(is_array($cartInfo)): foreach($cartInfo as $key=>$v): ?><tr>
							<td class="col1"><a href=""><img src="<?php echo substr($v['logo'],1);?>" alt="" /></a>  <strong><a href=""><?php echo ($v['goods_name']); ?></a></strong></td>
							<td class="col2"> <p>颜色：073深红</p> <p>尺码：170/92A/S</p> </td>
							<td class="col3">￥<?php echo ($v['goods_price']); ?></td>
							<td class="col4"> <?php echo ($v['goods_buy_number']); ?></td>
							<td class="col5"><span>￥<?php echo ($v['goods_total_price']); ?></span></td>
						</tr><?php endforeach; endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li>
										<span><?php echo ($number_price["number"]); ?>件商品，总商品金额：</span>
										<em>￥<?php echo ($number_price["price"]); ?></em>
									</li>
									<li>
										<span>应付总额：</span>
										<em>￥<?php echo ($number_price["price"]); ?></em>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 商品清单 end -->
		
		</div>

		<div class="fillin_ft">
			<input type="submit" value="提交订单">
			<p>应付总额：<strong>￥<?php echo ($number_price["price"]); ?></strong></p>
			
		</div>
	</div>
	<!-- 主体部分 end -->
	</form>
	<div style="clear:both;"></div>


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