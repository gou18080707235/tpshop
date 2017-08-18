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
            <form action="/index.php/Admin/Attribute/tianjia" method="post" >
                <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="general-tab-show">
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性名称：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <input type="text" name="attr_name"  id="attr_name"/>
                            <span style="color: red"><?php echo ((isset($errorInfo['attr_name']) && ($errorInfo['attr_name'] !== ""))?($errorInfo['attr_name']):'*'); ?></span>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">所属商品类型：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><select name="type_id"
                                                                                                    id="auth_pid">
                            <option value="0">请选择</option>

                            <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v['type_id']); ?>"><?php echo ($v['type_name']); ?></option><?php endforeach; endif; ?>
                        </select>
                        <span style="color: red"><?php echo ((isset($errorInfo['type_id']) && ($errorInfo['type_id'] !== ""))?($errorInfo['type_id']):'*'); ?></span>
                        </div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性是否可选</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="radio" name="attr_sel" value="only" checked="checked">唯一属性<input type="radio" name="attr_sel" value="many" checked="checked">单选属性</div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">属性值录入方式</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="radio" name="attr_write"  value="manual" checked="checked">手工录入<input type="radio" name="attr_write"  value="list" checked="checked">从下面列表选取</div></td>
                    </tr>
                    <tr>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">可选值列表：</span></div></td>
                        <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
                            <textarea name="attr_vals" id="" style="width: 400px;height: 90px;"></textarea>
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="100" height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="submit" value="提交" id="tianjia"></div></td>
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
            var info={'auth_name':$('#auth_name').val(),
                        'auth_pid':$('#auth_pid').val(),
                        'auth_c':$('#auth_c').val(),
                        'auth_a':$('#auth_a').val()
            };
            //console.log(info);
            $.ajax({
                url:"<?php echo U('tianjia');?>",
                type:'post',
                dataType:'json',
                data:info,
                success:function(msg){
                    if(msg.status==200){
                        alert(msg.message);
                        setTimeout('window.location.href="<?php echo U('showlist');?>"',3000);
                    }else if(msg.status==202){
                        alert(msg.message);
                        setTimeout('window.location.href="<?php echo U('showlist');?>"',2000);
                    }
                }
            });
        });
    });
</script>
</html>