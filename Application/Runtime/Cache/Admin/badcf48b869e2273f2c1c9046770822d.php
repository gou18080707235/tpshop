<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="/Public/Admin/js/jquery-1.8.3.js"></script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <style type="text/css">
        <!--
        body {
            margin-left: 3px;
            margin-top: 0px;
            margin-right: 3px;
            margin-bottom: 0px;
        }
        .STYLE1 {
            color: #e1e2e3;
            font-size: 12px;
        }
        .STYLE6 {color: #000000; font-size: 12; }
        .STYLE10 {color: #000000; font-size: 12px; }
        .STYLE19 {
            color: #344b50;
            font-size: 12px;
        }
        .STYLE21 {
            font-size: 12px;
            color: #3b6375;
        }
        .STYLE22 {
            font-size: 12px;
            color: #295568;
        }
        a:link{
            color:#e1e2e3; text-decoration:none;
        }
        a:visited{
            color:#e1e2e3; text-decoration:none;
        }
        -->
    </style>
</head>

<body>
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 商品列表</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
              <a href="<?php echo U('tianjia');?>"><img src="<?php echo C('AD_IMG_URL');?>add.gif" width="10" height="10" /> 添加</a>   &nbsp;
              </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>

    <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
            <tr>
                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6" colspan="100"><div align="center"><span class="STYLE10">订单基本信息</span></div></td>
            </tr>
            <tr>

                <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">用户名</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['username']); ?></span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">订单编号</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_number']); ?></span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">订单总金额</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_price']); ?></span></div></td>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">支付方式</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($paymethod[$orderInfo['order_pay']]); ?></span></div></td>
            </tr>
            <tr>
                <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">是否发货</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['is_send']=='否'?'未发货':'已发货'); ?></span></div></td>
                <td width="20%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">发票抬头</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_fapiao_title']=='0'?'个人':'公司'); ?></span></div></td>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">订单是否付款</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_status']=='0'?'未付款':'已付款'); ?></span></div></td>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">下单时间</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo date('Y-m-d H:i:s',$orderInfo['add_time']);?></span></div></td>
            </tr>
            <tr>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">发票公司</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_fapiao_company']); ?></span></div></td>

                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">发票内容</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['order_fapiao_content']); ?></span></div></td>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">收货人名称</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['cgn_name']); ?></span></div></td>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">收货人地址</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['cgn_address']); ?></span></div></td>
            </tr>
            <tr>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">联系电话</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['cgn_tel']); ?></span></div></td>
                <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">邮编</span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($orderInfo['cgn_code']); ?></span></div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE6" colspan="100"><div align="center"></span></div></td>
            </tr>
        </table></td>
    </tr>

</table>
<br/>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
    <tr>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6" colspan="100"><div align="center"><span class="STYLE10">订单关联商品信息</span></div></td>
    </tr>
    <tr>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品ID</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品名称</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">商品单价</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">购买数量</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">小计价格</span></div></td>

    </tr>
    <?php if(is_array($goodsInfo)): foreach($goodsInfo as $key=>$v): ?><tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($v['goods_id']); ?></span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($v['goods_name']); ?></span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['goods_price']); ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['goods_number']); ?></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['goods_total_price']); ?></div></td>

        </tr><?php endforeach; endif; ?>
</table>
<table align="center">
    <tr>
        <td>
            <div id="container" style="margin: auto;width: 700px;height: 500px;"></div>
        </td>
    </tr>
</table>
</body>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script>

    $(function () {
        var center = new qq.maps.LatLng(39.916527,116.397128);
        map = new qq.maps.Map(document.getElementById('container'),{
            center: center,
            zoom: 15
        });
        //调用地址解析类
        geocoder = new qq.maps.Geocoder({
            complete : function(result){
                map.setCenter(result.detail.location);
                var marker = new qq.maps.Marker({
                    map:map,
                    position: result.detail.location
                });
                var infoWin = new qq.maps.InfoWindow({
                    map: map
                });
                infoWin.open();
                //tips  自定义内容
                infoWin.setContent('<p>地址：</p><p><?php echo ($orderInfo['cgn_address']); ?></p>');
                infoWin.setPosition(marker);
            }
        });
        //获取用户填写的地址
        var address = "<?php echo ($orderInfo['cgn_address']); ?>";
        //alert(address);
        //通过getLocation();方法获取位置信息值
        geocoder.getLocation(address);
    })




</script>
</html>