<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>base.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>header.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>index.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?php echo C('CSS_URL');?>footer.css" type="text/css">

    <script type="text/javascript" src="<?php echo C('JS_URL');?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>header.js"></script>
    <script type="text/javascript" src="<?php echo C('JS_URL');?>index.js"></script>
</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">
        </div>
        <div class="topnav_right fr">
            <ul>
                <li>
                    <?php if($_SESSION['username']== '' ): ?>[<a href="<?php echo U('User/login');?>">登录</a>]
                        <?php else: ?>
                        您好 <?php echo (session('username')); ?>，欢迎来到京西！
                        [<a href="<?php echo U('User/logout');?>">退出登录</a>]<?php endif; ?>
                    [<a href="<?php echo U('User/regist');?>">免费注册</a>] </li>
                <li class="line">|</li>
                <li><a href="<?php echo U('PersonCenter/showlist');?>">我的订单</a></li>
                <li><a href="<?php echo U('PersonCenter/index');?>">个人中心</a></li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl">
                    <input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="">D-Link无线路由</a>
                <a href="">休闲男鞋</a>
                <a href="">TCL空调</a>
                <a href="">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="<?php echo U('user/center');?>">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        您好，请<a href="">登录</a>
                    </div>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="">用户信息></a></li>
                            <li><a href="">我的订单></a></li>
                            <li><a href="">收货地址></a></li>
                            <li><a href="">我的收藏></a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="">我的留言></a></li>
                            <li><a href="">我的红包></a></li>
                            <li><a href="">我的评论></a></li>
                            <li><a href="">资金管理></a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href=""><img src="/Public/Home/images/view_list1.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/Public/Home/images/view_list2.jpg" alt="" /></a></li>
                            <li><a href=""><img src="/Public/Home/images/view_list3.jpg" alt="" /></a></li>
                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
                    <a href="<?php echo U('shop/viewCart');?>">去购物车结算</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        购物车中还没有商品，赶紧选购吧！
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->

    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->

        <?php if(CONTROLLER_NAME== 'Index' and ACTION_NAME== 'index'): ?><div class="category fl"> <!-- 非首页，需要添加cat1类 -->
                <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                    <h2>全部商品分类</h2>
                    <em></em>
                </div>
                <div class="cat_bd"> <!--非首页，需要设置off类-->
                    <?php else: ?>
                    <div class="category fl cat1"> <!-- 非首页，需要添加cat1类 -->
                        <div class="cat_hd off">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                            <h2>全部商品分类</h2>
                            <em></em>
                        </div>
                        <div class="cat_bd none"> <!--非首页，需要设置none类--><?php endif; ?>

        <div class="cat item1">
            <h3><a href="">图像、音像、数字商品</a> <b></b></h3>
            <div class="cat_detail">
                <dl class="dl_1st">
                    <dt><a href="">电子书</a></dt>
                    <dd>
                        <a href="">免费</a>
                        <a href="">小说</a>
                        <a href="">励志与成功</a>
                        <a href="">婚恋/两性</a>
                        <a href="">文学</a>
                        <a href="">经管</a>
                        <a href="">畅读VIP</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">数字音乐</a></dt>
                    <dd>
                        <a href="">通俗流行</a>
                        <a href="">古典音乐</a>
                        <a href="">摇滚说唱</a>
                        <a href="">爵士蓝调</a>
                        <a href="">乡村民谣</a>
                        <a href="">有声读物</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">音像</a></dt>
                    <dd>
                        <a href="">音乐</a>
                        <a href="">影视</a>
                        <a href="">教育音像</a>
                        <a href="">游戏</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">文艺</a></dt>
                    <dd>
                        <a href="">小说</a>
                        <a href="">文学</a>
                        <a href="">青春文学</a>
                        <a href="">传纪</a>
                        <a href="">艺术</a>
                        <a href="">经管</a>
                        <a href="">畅读VIP</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">人文社科</a></dt>
                    <dd>
                        <a href="">历史</a>
                        <a href="">心理学</a>
                        <a href="">政治/军事</a>
                        <a href="">国学/古籍</a>
                        <a href="">哲学/宗教</a>
                        <a href="">社会科学</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">经管励志</a></dt>
                    <dd>
                        <a href="">经济</a>
                        <a href="">金融与投资</a>
                        <a href="">管理</a>
                        <a href="">励志与成功</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">人文社科</a></dt>
                    <dd>
                        <a href="">历史</a>
                        <a href="">心理学</a>
                        <a href="">政治/军事</a>
                        <a href="">国学/古籍</a>
                        <a href="">哲学/宗教</a>
                        <a href="">社会科学</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">生活</a></dt>
                    <dd>
                        <a href="">烹饪/美食</a>
                        <a href="">时尚/美妆</a>
                        <a href="">家居</a>
                        <a href="">娱乐/休闲</a>
                        <a href="">动漫/幽默</a>
                        <a href="">体育/运动</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">科技</a></dt>
                    <dd>
                        <a href="">科普</a>
                        <a href="">建筑</a>
                        <a href="">IT</a>
                        <a href="">医学</a>
                        <a href="">工业技术</a>
                        <a href="">电子/通信</a>
                        <a href="">农林</a>
                        <a href="">科学与自然</a>
                    </dd>
                </dl>

            </div>
        </div>

        <div class="cat">
            <h3><a href="">家用电器</a><b></b></h3>
            <div class="cat_detail">
                <dl class="dl_1st">
                    <dt><a href="">大家电</a></dt>
                    <dd>
                        <a href="">平板电视</a>
                        <a href="">空调</a>
                        <a href="">冰箱</a>
                        <a href="">洗衣机</a>
                        <a href="">热水器</a>
                        <a href="">DVD</a>
                        <a href="">烟机/灶具</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">生活电器</a></dt>
                    <dd>
                        <a href="">取暖器</a>
                        <a href="">加湿器</a>
                        <a href="">净化器</a>
                        <a href="">饮水机</a>
                        <a href="">净水设备</a>
                        <a href="">吸尘器</a>
                        <a href="">电风扇</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">厨房电器</a></dt>
                    <dd>
                        <a href="">电饭煲</a>
                        <a href="">豆浆机</a>
                        <a href="">面包机</a>
                        <a href="">咖啡机</a>
                        <a href="">微波炉</a>
                        <a href="">电磁炉</a>
                        <a href="">电水壶</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">个护健康</a></dt>
                    <dd>
                        <a href="">剃须刀</a>
                        <a href="">电吹风</a>
                        <a href="">按摩器</a>
                        <a href="">足浴盆</a>
                        <a href="">血压计</a>
                        <a href="">体温计</a>
                        <a href="">血糖仪</a>
                    </dd>
                </dl>

                <dl>
                    <dt><a href="">五金家装</a></dt>
                    <dd>
                        <a href="">灯具</a>
                        <a href="">LED灯</a>
                        <a href="">水槽</a>
                        <a href="">龙头</a>
                        <a href="">门铃</a>
                        <a href="">电器开关</a>
                        <a href="">插座</a>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="cat">
            <h3><a href="">手机、数码</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">电脑、办公</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">家局、家具、家装、厨具</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">服饰鞋帽</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">个护化妆</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">礼品箱包、钟表、珠宝</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">运动健康</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">汽车用品</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">母婴、玩具乐器</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">食品饮料、保健食品</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

        <div class="cat">
            <h3><a href="">彩票、旅行、充值、票务</a><b></b></h3>
            <div class="cat_detail none">

            </div>
        </div>

    </div>

</div>
<!--  商品分类部分 end-->

<div class="navitems fl">
    <ul class="fl">
        <li class="current"><a href="">首页</a></li>
        <li><a href="">手机频道</a></li>
        <li><a href="">家用电器</a></li>
        <li><a href="<?php echo U('Goods/showlist');?>">品牌大全</a></li>
        <li><a href="">团购</a></li>
        <li><a href="">积分商城</a></li>
        <li><a href="">夺宝奇兵</a></li>
    </ul>
    <div class="right_corner fl"></div>
</div>
</div>
<!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<!--设置一个"代表"，可以分别代表当前被请求的模板文件内容
具体模板文件内容执行解析的过程中，会过来替换如下__ CONTENT __
-->

		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="stylesheet" href="/Public/Home/style/safe/css.css" />
		<link rel="stylesheet" href="/Public/Home/style/safe/common.min.css" />
		<link rel="stylesheet" href="/Public/Home/style/safe/ms-style.min.css" />
		<link rel="stylesheet" href="/Public/Home/style/safe/personal_member.min.css" />
		<link rel="stylesheet" href="/Public/Home/style/safe/Snaddress.min.css" />
		<link rel="stylesheet" href="/Public/Home/style/sui.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="js/sui.js" ></script>
		<style>
		body {
		    background: #f5f5f5;
		}
			.sui-table th{
		    padding: 16px 8px;
		    line-height: 18px;
		    text-align: center;
		    vertical-align: middle;
		    border-top: 1px solid #e6e6e6;
		    font-weight: normal;
		    font-size: 14px;
		    color: #333333;
		   }
		   .sui-table td {
		    padding: 16px 8px;
		    line-height: 18px;
		    text-align: center;
		    vertical-align: middle;
		    border-top: 1px solid #e6e6e6;
		    font-weight: normal;
		    font-size: 12px;
		    color: #333333;
		   }
	img {
	    max-width: 100%;
	    height: auto;
	    /*vertical-align: bottom;*/
	    border: 0;
	    -ms-interpolation-mode: bicubic;
	    margin-left: -10px;
	}
a{
	color: #000000;
}
		</style>


	<body class="ms-body">

		<header class="ms-header ms-header-inner ms-head-position">
			<article class="ms-header-menu">
				<style type="text/css">
					.nav-manage .list-nav-manage {
						position: absolute;
						padding: 15px 4px 10px 15px;
						left: 0;
						top: -15px;
						width: 90px;
						background: #FFF;
						box-shadow: 1px 1px 2px #e3e3e3, -1px 1px 2px #e3e3e3;
						z-index: 10;
					}
					
					.ms-nav li {
						float: left;
						position: relative;
						padding: 0 20px;
						height: 44px;
						font: 14px/26px "Microsoft YaHei";
						color: #FFF;
						cursor: pointer;
						z-index: 10;
					}
					.personal-member .main-wrap {
    width: 1068px;
    margin: 15px 0 30px 180px;
    padding: 0 0 39px 0;
    border: 1px solid #ddd;
    background: none;
}
				</style>
				<div class="header-menu">
					<nav class="ms-nav">
						<ul>

								<div class="list-nav-manage " hidden>
									<p class="nav-mge-hover">账户管理<em></em></p>
									<p><a >个人资料</a></p>
									<p><a >安全设置</a></p>
									<p><a >账号绑定</a></p>
									<p><a >地址管理</a></p>

								</div>
							</li>

						</ul>
					</nav>
				</div>



			<article class="ms-useinfo">
				<div class="header-useinfo" id="">
					<div class="ms-avatar">
						<a>sunshine</a>
					</div>

					<div class="ms-name-info">
						<div class="link-myinfo">
							<a>我的编号:99653</a>
						</div>
						<div class="info-member">
							<span class="name-member member-1">
        				 <i></i><a target="_blank" >注册会员</a></span>
							<span style="margin-left: 20px;">
        				 <a target="_blank" >我的资料</a></span>
						</div>
						<div class="info-safety">
							<span class="safety-lv lv-3">
        				<a >安全等级：<span>中</span></a>
							</span>
							<a class="bind-phone">
								<i style="background-image: url(/Public/Home/images/修改手机.png);"></i>修改手机</a>
							<a class="bind-email">
								<i style="background-image: url(/Public/Home/images/绑定邮箱.png);"></i>修改邮箱</a>
							<a class="manage-addr"><i style="background-image: url(/Public/Home/images/地址管理.png);"></i>地址管理</a>
						</div>
					</div>
				</div>


		<div id="ms-center" class="personal-member">
			<div class="cont">
				<div class="cont-side">
					<div class="side-neck" style="margin-top: 20px;">
						<i></i>
					</div>
					<div class="ms-side" style="margin-top: 20px;">
						<article class="side-menu side-menu-off">
							<dl class="side-menu-tree" style="padding-left: 50px;">
								<dt><img src="/Public/Home/images/左侧/我的购物车.png"  style="margin-right: 10px;margin-left: -20px;"/>我的购物车</dt>
								<dt><img src="/Public/Home/images/左侧/file.png"  style="margin-right: 10px;margin-left: -20px;"/>订单管理</dt>
								<dd>
									<a>我的订单</a>

								</dd>
								<dd>
									<a>我的收藏</a>

								</dd>
								<dd>
									<a >我的评价</a>

								</dd>
								<dd>
									<a >我的足迹</a>

								</dd>
								<dd>
									<a >我的拍卖</a>

								</dd>
								<dd>
									<a>我的优惠券</a>

								</dd>
								<dt><img src="/Public/Home/images/左侧/我的买啦.png"  style="margin-right: 10px;margin-left: -20px;"/>我的买啦</dt>
								<dd>
									<a>我的推荐</a>

								</dd>
								<dd>
									<a>我的钱包</a>

								</dd>
								<dd>
									<a>我要提现</a>

								</dd>
								<dd>
									<a>我的买豆</a>

								</dd>
								<dd>
									<a >邀请管理</a>

								</dd>
								<dt><img src="/Public/Home/images/左侧/v-card-3.png"  style="margin-right: 10px;margin-left: -20px;"/>售后服务</dt>
								<dd>
									<a >退换货</a>

								</dd>
								<dd>
									<a>意见/投诉</a>

								</dd>
							</dl>

							<a ison="on" class="switch-side-menu icon-up-side"><i></i></a>
						</article>
					</div>
				</div>
				<div class="cont-main">
					<div class="main-wrap mt15" style="border: 0px;">
						<!--<h3>
	                        <strong>我的会员等级</strong>
	                    </h3>-->
						<div class="server-wrapper">
							<div class="server-tab" style="margin-top: 26px;">
								<div style=" float: left;vertical-align: bottom;text-align: center;">
								<div style="width: 680px;padding: 10px;float: left;background-color: #fff;height: 250px;">
								<div style="float: left;width:200px ;height: 152px;border: 1px #ccc solid;box-shadow: 1px 1px 1px #F5F5F5;padding: 5px;">
									<div style="width: 100%;height: 100%;border: 1px #F2873B dashed;">
										<span style="font-size: 18px;color: #686868;font-weight: bold;display: block;    display: block; width: 100px; margin-left: 50px;    margin-top:20px;">2016年4月</span>
										<span style="font-size: 36px;color: #F88600;display: block;    display: block; width: 100px; margin-left: 50px;margin-top: 28;">12</span>
									     <input  type="button" value="签到领买豆" style="background-color: #f56a48;border-radius: 5px;color: #fff; font-size:14px;border: 0px;width: 107px;height: 26px;margin-top: 30px;" />
									</div>
								</div>
								
								<div style="float: left;width:200px ;height: 152px;;margin-left: 20px;border: 1px #ccc solid;box-shadow: 1px 1px 1px #F5F5F5;padding: 5px;">
									<div style="width: 100%;height: 100%;border: 1px #F2873B dashed;">
										<span style="font-size: 18px;color: #686868;font-weight: bold;display: block;    display: block; width: 100px; margin-left: 50px; margin-bottom: 20px;   margin-top: 20px;">我的资产</span>
									    <span style="width: 87px;height: 20px;background-color: #fee3dc;padding: 5px;border: 1px #C62B26 dashed;border-radius: 5px;">显示今日收益</span>
										<img src="/Public/Home/images/我的买豆/矢量智能对象.png" style="position: absolute; margin-top: 30px;  margin-left: -80px;;" />	
									</div>
								</div>
								
								<div style="float: left;width:200px ;height: 152px;margin-left: 20px;border: 1px #ccc solid;box-shadow: 1px 1px 1px #F5F5F5;padding: 5px;">
									<div style="width: 100%;height: 100%;border: 1px #F2873B dashed;">
										<span style="font-size: 18px;color: #686868;font-weight: bold;display: block;    display: block; width: 100px; margin-left: 50px;    margin-top: 20px; margin-bottom: 20px;">我的买豆</span>
										<span style="width: 87px;height: 20px;background-color: #fee3dc;padding: 5px;border: 1px #C62B26 dashed;border-radius: 5px;">显示今日收益</span>
									    <img src="/Public/Home/images/我的买豆/猪的图标.png" style="position: absolute; margin-top: 13px;  margin-left: -80px;;" />									</div>
								</div>
								
								<div style="border-top:1px #ccc solid;width: 650px;position: absolute;margin-top: 200px;margin-left: 20px;float: left;"></div>
								<div style="position: absolute;margin-top: 230px;font-size: 14px;color: #686868;float: left;">
									<span style="margin-left: 20px;">待付款</span>
									<font style="color: #CF2D27;">0</font>
									<span style="margin-left: 40px;margin-right: 40px;">|</span>
									<span >待发货</span>
									<font style="color: #CF2D27;">0</font>
									<span style="margin-left: 40px;margin-right: 40px;">|</span>
									<span>待收货</span>
									<font style="color: #CF2D27;">0</font>
									<span style="margin-left: 40px;margin-right: 40px;">|</span>
									<span>待评价</span>
									<font style="color: #CF2D27;">0</font>
									<span style="margin-left: 40px;margin-right: 40px;">|</span>
									<span>退款</span>
									
								</div>
								</div>	
								
								
								<!--
                                	作者：右侧
                                	时间：2016-05-24
                                	描述：
                                -->
								<div style="float: left;width:250px ;height: 152px;margin-left: 20px;">
								 <p style="font-size: 14px;color: #686868;text-align:center;background-color: #fff;padding: 10px;color: #F88600;font-size: 14px;">菜单管理</p>
								 <div style="background-color: #fff;margin-top: 10px;height: 300px;padding: 10px;">
								 	<p style="font-size: 16px;text-align: left;">我的优惠券</p>
								 	<img src="/Public/Home/images/个人中心/组-15.png"/>
								 	<img src="/Public/Home/images/个人中心/组-14.png" style="margin-top: 20px;"/>
								 	<p style="margin-top: 30px;font-size: 14px;color: #686868;">全部优惠券(<font color="red">96</font>)</p>
								 </div>
								
								<div style="background-color: #fff;margin-top: 10px;height: 200px;padding: 10px;">
								 	<p style="font-size: 20px;text-align: left;">收藏的商品</p>
								 	<img src="/Public/Home/images/个人中心/形状-1.png" style="margin-top: 20px;"/>
								 	<p style="margin-top: 30px;font-size: 14px;color: #686868;">您的收藏空空的，赶紧<br/>
								 	去首页看看购物吧</p>
								 </div>
								
								<div style="background-color: #fff;margin-top: 10px;height: 300px;padding: 10px;">
								 	<p style="font-size: 16px;text-align: left;">购物车</p>
								 	<div style="float:left ;">
								 	<img src="/Public/Home/images/个人中心/屏幕快照-2016-04-08-15.50.46.png" style="margin-top: 10px;height: 100px;width: 100px;float: left;"/>	
								 	<br />
								 	<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	<del style="float: left;margin-left: 20px;">¥189</del>
								 	<p style="width: 100px;font-size: 12px;color: #686868">化妆水化妆水化妆水化妆水化妆水化妆水</p>
								 	</div>
								 	 <div style="float:left ;">
								 	 	 <img src="/Public/Home/images/个人中心/屏幕快照-2016-04-08-15.50.46.png" style="margin-top: 10px;height: 100px;width: 100px;float: left;margin-left: 20px;"/>
								 	 	<br />
								 	<span style="display: block;float: left;margin-left: 40px;color: #f78642;font-size: 16px;">¥156</span>
								 	<del style="float: left;margin-left: 20px;">¥189</del>
								 		<p style="width: 100px;margin-left: 20px;font-size: 12px;color: #686868;">化妆水化妆水化妆水化妆水化妆水化妆水</p>
								 	 </div>
								 	
								   <p style="margin-top: 30px;font-size: 14px;color: #686868;">查看购物车(<font color="red">96</font>)</p>
								   
								</div>
								
								
								<div style="background-color: #fff;margin-top: 10px;height: 200px;padding: 10px;">
								 	<p style="font-size: 16px;text-align: left;">我的足迹</p>
								 	<img src="/Public/Home/images/个人中心/矢量智能对象.png" style="margin-top: 20px;"/>
								 	<p style="margin-top: 30px;font-size: 14px;color: #686868;">您还没有留下任何足迹呢！</p>
								 </div>
								
								
								</div>
								
								<!--右侧---end------->
								
								<div style="width: 680px;padding:10px;display: inline-block; float: left;margin-top: 20px;background-color: #fff;">
									<div style="border-bottom: 1px #ccc solid;">
										<p style="font-size: 20px;text-align: left;">我的物流</p>
									</div>
									<div style="padding: 20px 20px;border-bottom: 1px #F5F5F5 solid;height: 150px;">
										<div style="float: left;margin-top: 10px;">
											<img src="/Public/Home/images/宝贝收藏/组-58.png" />
										</div>
										<div style="float: left;margin-top: 20px;">
											<p>在浙江临安市公司市区北方扫描，快件已被签收</p>
											<p>2016-04-10 12:20:30  <strong>查看物流信息</strong> </p>
										</div>
										<div style="float: right;margin-right: 20px;margin-top: 50px;">
											<button style="border: 1px #ccc solid;padding: 5px;background-color: #fff;">确认收货</button>
										</div>
										
									</div>
									<div style="padding: 20px 20px;border-bottom: 1px #F5F5F5 solid;height: 150px;">
										<div style="float: left;margin-top: 10px;">
											<img src="/Public/Home/images/宝贝收藏/组-56.png" />
										</div>
										<div style="float: left;margin-top: 20px;">
											<p>在浙江临安市公司市区北方扫描，快件已被签收</p>
											<p>2016-04-10 12:20:30  <strong>查看物流信息</strong> </p>
										</div>
										<div style="float: right;margin-right: 20px;margin-top: 50px;">
											<button style="border: 1px #ccc solid;padding: 5px;background-color: #fff;">确认收货</button>
										</div>
										
									</div>
									<div style="padding: 20px 20px;border-bottom: 1px #F5F5F5 solid;height: 150px;">
										<div style="float: left;margin-top: 10px;">
											<img src="/Public/Home/images/宝贝收藏/组-57.png" />
										</div>
										<div style="float: left;margin-top: 20px;">
											<p>在浙江临安市公司市区北方扫描，快件已被签收</p>
											<p>2016-04-10 12:20:30  <strong>查看物流信息</strong> </p>
										</div>
										<div style="float: right;margin-right: 20px;margin-top: 50px;">
											<button style="border: 1px #ccc solid;padding: 5px;background-color: #fff;">确认收货</button>
										</div>
										
									</div>
									<p style="text-align: center;margin-top: 30px;">展开全部信息</p>
									 <!--<div style="float:left;display: inline;border: 1px #ccc solid;display: inline-block;background-color: #f5f5f5;height: 25px;width: 150px;"> 
                                        <input type="text" placeholder="搜索会员编号"  style="padding-left:5px;width:130px;border: 0px;background-color: #fff;line-height: 25px;border-right: 0px #ccc solid;" />
									    <img src="/Public/Home/images/搜索.png"  style="height: 10px;width: 10px;  margin-left: 2px; margin-bottom: 5px;" />
                                        </div> -->
								</div>
								
								<div style="width: 680px;padding:10px;display: inline-block; margin-top: 20px;background-color: #fff;float: left;border-bottom: 1px #ccc solid;padding-bottom: 20px;">
									<span style="text-align: left;line-height: 20px;">根据浏览 猜你喜欢</span>
								</div>
								<div style="width: 680px;padding:10px;display: inline-block; margin-top:0px;background-color: #fff;float: left;">
									<div style="padding:10px ;text-align: center;float: left;">
										<div style="float: left;margin-left: 30px">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
										<div style="float: left;margin-left: 30px">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
										<div style="float: left;margin-left: 30px;">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
									</div>
									
									<div style="padding:10px ;text-align: center;float: left;">
										<div style="float: left;margin-left: 30px">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
										<div style="float: left;margin-left: 30px">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
										<div style="float: left;margin-left: 30px;">
											<img src="/Public/Home/images/wdxx_01.png" />
											<p style="width: 180px;">乐扣乐扣彼得兔水杯系列700ml便携式茶杯</p>
											<span style="display: block;float: left;margin-left: 10px;color: #f78642;font-size: 16px;">¥156</span>
								 	     <del style="margin-left: 0px;margin-top: 10px;">¥189</del>
								 	     <dl style="    float: left; margin-top: 30px; margin-left: -50px;">好评：90%</dl>
								 	     <dl style="float: right;margin-top: 30px;">月销量：56</dl>
										</div>
										
									</div>
									
									
								</div>
								
							
						</div>
					</div>
				</div>
				
			</div>
		</div>
		</div>
		<div class="clear "></div>
		<div class="ng-footer ">

			<textarea class="footer-dom " id="footer-dom-02 ">
			</textarea>
			<div class="ng-fix-bar "></div>
		</div>
		<style type="text/css ">
		
			.ng-footer {
				height: 130px;
				margin-top: 0;
			}
		
			
			.ng-s-footer {
				height: 130px;
				background: none;
				text-align: center;
			}
			
			.ng-s-footer p.ng-url-list {
				height: 25px;
				line-height: 25px;
			}
			
			.ng-s-footer p.ng-url-list a {
				color: #666666;
			}
			
			.ng-s-footer p.ng-url-list a:hover {
				color: #f60;
			}
			
			.ng-s-footer .ng-authentication {
				float: none;
				margin: 0 auto;
				height: 25px;
				width: 990px;
				margin-top: 5px;
			}
			
			.ng-s-footer p.ng-copyright {
				float: none;
				width: 100%;
			}
			
			.root1200 .ng-s-footer p.ng-copyright {
				width: 100%;
			}
		</style>
		<script type="text/javascript " src="js/safe/ms_common.min.js "></script>
		<div style="text-align:center;">
<p>来源:<a href="http://down.admin5.com" target="_blank">A5源码</a></p>
</div>
	</body>

</html>

<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
    <div class="bnav1">
        <h3><b></b> <em>购物指南</em></h3>
        <ul>
            <li><a href="">购物流程</a></li>
            <li><a href="">会员介绍</a></li>
            <li><a href="">团购/机票/充值/点卡</a></li>
            <li><a href="">常见问题</a></li>
            <li><a href="">大家电</a></li>
            <li><a href="">联系客服</a></li>
        </ul>
    </div>

    <div class="bnav2">
        <h3><b></b> <em>配送方式</em></h3>
        <ul>
            <li><a href="">上门自提</a></li>
            <li><a href="">快速运输</a></li>
            <li><a href="">特快专递（EMS）</a></li>
            <li><a href="">如何送礼</a></li>
            <li><a href="">海外购物</a></li>
        </ul>
    </div>


    <div class="bnav3">
        <h3><b></b> <em>支付方式</em></h3>
        <ul>
            <li><a href="">货到付款</a></li>
            <li><a href="">在线支付</a></li>
            <li><a href="">分期付款</a></li>
            <li><a href="">邮局汇款</a></li>
            <li><a href="">公司转账</a></li>
        </ul>
    </div>

    <div class="bnav4">
        <h3><b></b> <em>售后服务</em></h3>
        <ul>
            <li><a href="">退换货政策</a></li>
            <li><a href="">退换货流程</a></li>
            <li><a href="">价格保护</a></li>
            <li><a href="">退款说明</a></li>
            <li><a href="">返修/退换货</a></li>
            <li><a href="">退款申请</a></li>
        </ul>
    </div>

    <div class="bnav5">
        <h3><b></b> <em>特色服务</em></h3>
        <ul>
            <li><a href="">夺宝岛</a></li>
            <li><a href="">DIY装机</a></li>
            <li><a href="">延保服务</a></li>
            <li><a href="">家电下乡</a></li>
            <li><a href="">京东礼品卡</a></li>
            <li><a href="">能效补贴</a></li>
        </ul>
    </div>
</div>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
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
        <a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
        <a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
        <a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->

</body>
</html>