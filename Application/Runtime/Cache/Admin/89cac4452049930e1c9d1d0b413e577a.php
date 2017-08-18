<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="6%" height="19" valign="bottom"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>tb.gif" width="14" height="14" /></div></td>
                                <td width="94%" valign="bottom"><span class="STYLE1"> 角色管理 -> 分配权限</span></td>
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
                <td height="40" bgcolor="d3eaef" class="STYLE10" colspan="100"><div align="center">
                  当前正在给<span style="font-size: 25px;color: #aa00aa;"><?php echo ($role_info['role_name']); ?></span>分配权限
                </div></td>
            </tr>
            <form action="/index.php/Admin/Role/distribute/role_id/30.html" method="post">
                <input type="hidden" name="role_id" value="<?php echo ($role_info['role_id']); ?>">
            <?php if(is_array($authinfoA)): foreach($authinfoA as $key=>$v): ?><tr>
                <td width="15%" height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center" ><input type="checkbox" name="auth_id[]" id="checkbox" value="<?php echo ($v['auth_id']); ?>" <?php if(in_array(($v["auth_id"]), is_array($role_info["role_auth_ids"])?$role_info["role_auth_ids"]:explode(',',$role_info["role_auth_ids"]))): ?>checked='checked'<?php endif; ?>/><span class="STYLE19"><?php echo ($v['auth_name']); ?></span></div></td>

                <td width="15%" height="20" bgcolor="#FFFFFF" class="STYLE6">
                    <?php if(is_array($authinfoB)): foreach($authinfoB as $key=>$vv): if(($vv["auth_pid"]) == $v['auth_id']): ?><div align="center" style="float: left;margin: 20px;"><input type="checkbox" name="auth_id[]" id="" value="<?php echo ($vv['auth_id']); ?>" <?php if(in_array(($vv["auth_id"]), is_array($role_info["role_auth_ids"])?$role_info["role_auth_ids"]:explode(',',$role_info["role_auth_ids"]))): ?>checked='checked'<?php endif; ?>/><span class="STYLE19"><?php echo ($vv['auth_name']); ?></span></div><?php endif; endforeach; endif; ?>
                </td>

            </tr><?php endforeach; endif; ?>

        </table></td>
    </tr>
    <tr >
        <td bgcolor="#FFFFFF" class="STYLE6"><input type="submit" value="提交" colspan="100"></td>
    </tr>
    </form>
    <tr>
        <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="33%"><div align="left"><span class="STYLE22">&nbsp;&nbsp;&nbsp;&nbsp;共有<strong> 243</strong> 条记录，当前第<strong> 1</strong> 页，共 <strong>10</strong> 页</span></div></td>
                <td width="67%"><table width="312" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="49"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>main_54.gif" width="40" height="15" /></div></td>
                        <td width="49"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>main_56.gif" width="45" height="15" /></div></td>
                        <td width="49"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>main_58.gif" width="45" height="15" /></div></td>
                        <td width="49"><div align="center"><img src="<?php echo C('AD_IMG_URL');?>main_60.gif" width="40" height="15" /></div></td>
                        <td width="37" class="STYLE22"><div align="center">转到</div></td>
                        <td width="22"><div align="center">
                            <input type="text" name="textfield" id="textfield"  style="width:20px; height:12px; font-size:12px; border:solid 1px #7aaebd;"/>
                        </div></td>
                        <td width="22" class="STYLE22"><div align="center">页</div></td>
                        <td width="35"><img src="<?php echo C('AD_IMG_URL');?>main_62.gif" width="26" height="15" /></td>
                    </tr>
                </table></td>
            </tr>
        </table></td>
    </tr>
</table>
<?php echo ($info['show']); ?>
</body>
</html>