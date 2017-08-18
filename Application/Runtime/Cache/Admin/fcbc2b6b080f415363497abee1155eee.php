<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <script src="<?php echo C('PLUGIN_URL');?>/Ueditor/ueditor.config.js" type="text/javascript"></script>
    <script src="<?php echo C('PLUGIN_URL');?>/Ueditor/ueditor.all.min.js" type="text/javascript"></script>
    <script src="<?php echo C('PLUGIN_URL');?>/Ueditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
    <script src="<?php echo C('AD_JS_URL');?>/jquery-1.8.3.js"></script>
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
<style type="text/css">
    #tabbar-div {
        background: #80bdcb none repeat scroll 0 0;
        height: 22px;
        padding-left: 10px;
        padding-top: 1px;
        margin-bottom: 3px;
    }
    #tabbar-div p { margin: 2px 0 0;font-size:12px;
    }
    .tab-front {
        background: #bbdde5 none repeat scroll 0 0;
        border-right: 2px solid #278296;
        cursor: pointer;
        font-weight: bold;
        line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
    .tab-back {
        border-right: 1px solid #fff;
        color: #fff; cursor: pointer;line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
</style>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 商品管理 -> 添加商品</span></td>
                            </tr>
                        </table></td>
                        <td><div align="right"><span class="STYLE1">
            <a href="<?php echo U('showlist');?>">返回</a>   &nbsp; </span>
                            <span class="STYLE1"> &nbsp;</span></div></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr>
        <td colspan="100">
            <div id="tabbar-div">
                <p>
                    <span class="tab-front" id="general-tab">通用信息</span>
                </p>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <form action="/index.php/Admin/MemberLevel/upd/id/28.html" method="post" >
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="general-tab-show">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">会员名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="level_name"  id="level_name" value="<?php echo ($info['level_name']); ?>"/>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">折扣率：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="level_rate"  id="level_rate" value="<?php echo ($info['level_rate']); ?>"/></div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">基本下限：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="jifen_bottom" id="jifen_bottom" value="<?php echo ($info['jifen_bottom']); ?>"/></div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">积分上限：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="jifen_top"  id="jifen_top" value="<?php echo ($info['jifen_top']); ?>"/></div></td>
                    </tr>
                    <tr>
                        <td colspan="100" height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="button" value="提交" id="tianjia"></div></td>
                    </tr>
</table>

</form>
</td>
</tr>
</table>
</body>
<script>
    $(function(){
        $('#tianjia').click(function(){
            var info={'level_name':$('#level_name').val(),
                        'level_rate':$('#level_rate').val(),
                        'jifen_bottom':$('#jifen_bottom').val(),
                        'jifen_top':$('#jifen_top').val()
            };
            console.log(info);
            $.ajax({
                url:"/index.php/Admin/MemberLevel/upd",
                type:'post',
                dataType:'json',
                data:info,
                success:function(msg){
                    if(msg.status==200){
                        alert('修改成功');
                        setTimeout('window.location.href="<?php echo U('showlist');?>"',1000);
                    }else if(msg.status==202){
                        alert('修改失败');
                        setTimeout('window.location.href="<?php echo U('addMember');?>"',2000);
                    }
                }
            });
        });
    });
</script>
</html>