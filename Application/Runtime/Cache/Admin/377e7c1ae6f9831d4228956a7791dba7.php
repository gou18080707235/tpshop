<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="/Public/Admin/js/jquery-1.8.3.js"></script>
  <script src="/Public/Admin/js/layui.js"></script>
  <script src="/Public/Admin/js/layer.js"></script>
  <link rel="stylesheet" href="/Public/Admin/css/layui.css" type="text/css">
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
        <td width="4%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
          <input type="checkbox" name="checkbox" id="checkbox" />
        </div></td>
        <td width="5%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">会员ID</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">会员名称</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">会员邮箱</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">会员状态</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">会员QQ</span></div></td>
        <td width="10%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">最后登录时间</span></div></td>
        <td width="*" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
      </tr>
      <?php if(is_array($userInfo)): foreach($userInfo as $key=>$v): ?><tr>
        <td height="40" bgcolor="#FFFFFF"><div align="center">
          <input type="checkbox" name="checkbox2" id="checkbox2" />
        </div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($v['user_id']); ?></span></div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><span class="STYLE19"><?php echo ($v['username']); ?></span></div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['user_email']); ?></div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo ($v['user_sex']); ?></div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE19"><span align="center"><?php
 if($v['flag']==1){ echo '<span style="color:blue">正常</span>'; }else if($v['flag']==2){ echo '<span style="color:red">冻结中</span>'; } ?></div></td>
        <td height="40" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo date('Y-m-d',$v['last_time']);?></div></td>
        <td height="40" bgcolor="#FFFFFF"><div align="center" class="STYLE21">
          <?php if(($v['flag']) == "1"): ?><input type="button" value="冻结" onclick="dongjie(<?php echo ($v['user_id']); ?>)" class="layui-btn layui-btn-small layui-btn-danger">
            <?php else: ?>
            <input type="button" value="继续冻结" onclick="dongjie(<?php echo ($v['user_id']); ?>)" class="layui-btn layui-btn-small layui-btn-warm">
            <input type="button" value="解除冻结" onclick="jiechu(<?php echo ($v['user_id']); ?>)" class="layui-btn layui-btn-small layui-btn-warm"><?php endif; ?>
          |
          <button class="layui-btn layui-btn-small">删除</button></div></td>
      </tr><?php endforeach; endif; ?>
    </table></td>
  </tr>
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
</body>
<script>
  function dongjie(user_id){
      if(confirm('您真的要冻结该账户吗？')){
          var time=prompt('请输入天数');
          alert(user_id);
          $.ajax({
              url:"/index.php/Admin/User/dj_user",
              type:'post',
              data:{'time':time,'user_id':user_id},
              dataType:'json',
              success:function(msg){
                  if(msg.status==200){
                      alert('冻结成功');
                      window.location.href="<?php echo U('showlist');?>";
                  }else{
                      alert('冻结失败');
                  }
              }
          });
      }
  }
</script>
<script>
  function jiechu(user_id){
      if(confirm('您确定要解除冻结吗')){
          $.ajax({
              url:"/index.php/Admin/User/jiechu",
              type:'post',
              data:{'user_id':user_id},
              dataType:'json',
              success:function(msg){
                  if(msg.status==200){
                      alert('解除冻结成功');
                      window.location.href="<?php echo U('showlist');?>";
                  }else{
                      alert('解除冻结失败');
                  }
              }
          });
      }
  }
</script>
</html>