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
<script>
    $(function () {
        $('#tabbar-div span').click(function () {
            //当前的标签高亮显示，其他的兄弟标签变暗  siblings()获取当前标签的其他兄弟标签
            $(this).attr('class','tab-front').siblings().attr('class','tab-back');
            //获取表格ID值
            var table_id =$(this).attr('id');
            //让全部的表格隐藏。都是已-tab-show结尾
            $('[id$=-tab-show]').hide();
            //让当前的表格显示
            $('#'+table_id+'-show').show();
        });
    });
</script>
<script>
    function add_pics_item(obj){
        var addtr=$(obj).parent().parent().parent();//获取TR标签对象，一共三个父级PARENT()
        var futr=addtr.clone();//复制一个TR
        //制作一个TR出来
        var sp="<span class='STYLE19' onclick='$(this).parent().parent().parent().remove()'>[-]商品相册：</span>";
        //删除futr内部[+]对相应的span
        futr.find('span').remove();
        //把[-]追加进去
        futr.find('div[align=right]').append(sp);
        //把futr追加给TABLE
        $('#gallery-tab-show').append(futr);
    }
</script>
<script>
  function del_pic(pics_id){
      $.ajax({
          url:"<?php echo U('delPics');?>",
          data:{'pics_id':pics_id},
          dataType:'json',
          type:'post',
          success:function(msg){
              if(msg.status===0){
                  $('#pics_show_'+pics_id).remove();
                  alert('删除成功');
              }
          }
      });
  }
</script>
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
          <span class="tab-back" id="detail-tab">详细描述</span>
          <span class="tab-back" id="mix-tab">其他信息</span>
          <span class="tab-back" id="properties-tab">商品属性</span>
          <span class="tab-back" id="gallery-tab">商品相册</span>
          <span class="tab-back" id="linkgoods-tab">关联商品</span>
          <span class="tab-back" id="groupgoods-tab">配件</span>
          <span class="tab-back" id="article-tab">关联文章</span>
        </p>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <form action="/index.php/Admin/Goods/upd/goods_id/44.html" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="general-tab-show">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品名称：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="goods_name" onblur="" id="check1" value="<?php echo ($info['goods_name']); ?>"/><span id="res1" ></span>
            </div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">价格：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_price" value="<?php echo ($info['goods_price']); ?>"/></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">数量：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_number" value="<?php echo ($info['goods_number']); ?>"/></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">重量：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left"><input type="text" name="goods_weight" value="<?php echo ($info['goods_weight']); ?>"/></div></td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品logo：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="file" name="goods_logo" /><img src="<?php echo substr($info['goods_small_logo'],1);?>" alt="赞无图片" width="80"></div></td>

          </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id='detail-tab-show' style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">详情描述：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <textarea style="width:620px; height:200px;" id="goods_introduce" name="goods_introduce"><?php echo ($info['goods_introduce']); ?></textarea>
            </div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="mix-tab-show" style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">其他信息：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="goods_qita" />
            </div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="properties-tab-show" style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">商品属性：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="hidden" name="goods_id" value="<?php echo ($info['goods_id']); ?>">
              <select name="type_id" id="type_id" onchange="get_attr_info2()">
                <option value="0">--请选择--</option>
                <?php if(is_array($typeInfo)): foreach($typeInfo as $key=>$v): ?><option value="<?php echo ($v['type_id']); ?>" <?php if(($info['type_id']) == $v['type_id']): ?>selected='selected'<?php endif; ?>><?php echo ($v['type_name']); ?></option><?php endforeach; endif; ?>
              </select>
            </div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="gallery-tab-show" style="display:none">
          <tr>
            <td colspan="100">
              <ul >
                <?php if(is_array($picsinfo)): foreach($picsinfo as $key=>$v): ?><li style="list-style: none;float: left" id="pics_show_<?php echo ($v['pics_id']); ?>">
                  <img src="<?php echo substr($v['pics_mid'],1);?>" alt="暂无相册" width="135"><span style="color: red" onclick=" if(confirm('您真的要删除吗')){del_pic(<?php echo ($v["pics_id"]); ?>)}">[-]</span>
                </li><?php endforeach; endif; ?>
              </ul>
            </td>
          </tr>
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right" >
              <span class="STYLE19" onclick="add_pics_item(this)"> [+]商品相册：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="file" name="goods_pics[]" />
            </div></td>
          </tr>

        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="linkgoods-tab-show" style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联商品：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="" />
            </div></td>
          </tr>

        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="groupgoods-tab-show" style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">配件：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="" />
            </div></td>
          </tr>

        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" id="article-tab-show" style="display:none">
          <tr>
            <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">关联文章：</span></div></td>
            <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="left">
              <input type="text" name="" />
            </div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce"
  <tr>
    <td colspan='100'  bgcolor="#FFFFFF"  class="STYLE6" style="text-align:center;">
      <input type="submit" value="添加" />
    </td>
  </tr>
</table>
</form>
</td>
</tr>
</table>
</body>
<script type="text/javascript">
    var ue = UE.getEditor('goods_introduce',{toolbars: [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
        'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage'
    ]]});
</script>
<script>
  $(function(){
      //当页面加载完成后自动调用
      get_attr_info2();
  });
  function get_attr_info2(){
      //获取Goods_id与type_id
      var goods_id=$('[name=goods_id]').val();
      var type_id=$('#type_id').val();
      //AJAX去服务器获取相关属性信息
      $.ajax({
          type:'get',
          url:'/index.php/Admin/Goods/getAttrByType2',
          data:{goods_id:goods_id,type_id:type_id},
          dataType:'json',
          success:function(msg){
              var s='';
              $.each(msg,function (n,v) {
                  //如果商品属性是唯一的，则显示Input框
                  if(v.attr_sel=='only'){
                      s += '<tr> <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><span class="STYLE19">'+v.attr_name+':</span></div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"> <div align="left">';
                      //如果用户没有设置属性,则显示input框
                      if(v.attr_values==null){
                          s+='<input type="text" name="attr_info['+v.attr_id+'][]" />';
                      }else{
                          //用户设置了属性，则显示用户所选择的属性
                          s+='<input type="text" name="attr_info['+v.attr_id+'][]" value="'+v.attr_values+'"/>';
                      }
                      s+='</div></td></tr>';
                      //如果商品属性不是唯一的，则显示select下拉列表
                  }else{
                      //如果用户设置的属性为空，则显示select下拉列表
                      if(v.attr_values==null){
                          s += '<tr> <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right"><e class="STYLE19" onclick="add_attr2(this)">[+]</e><span class="STYLE19">'+v.attr_name+'：</span></div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"> <div align="left"> <select name="attr_info['+v.attr_id+'][]"><option value="0">-请选择-</option>';
                          var attr_values=v.attr_vals.split(',');//将字符串通过逗号转换为数组
                          //循环下拉列表
                          for(var i=0; i<attr_values.length; i++){
                              s+='<option value="'+attr_values[i]+'">'+attr_values[i]+'</option>';
                          }
                          s+='</select></div></td></tr>';
                      }else{
                          //用户设置了值，则显示用户设置的值
                          var now_values=v.attr_values.split(',');
                          //循环用户设置的值
                          for(var k=0;k<now_values.length;k++){
                              s+='<tr> <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="right">';
                              //第一个下拉列表则显示[+]
                              if(k==0){
                                  s+='<e class="STYLE19" onclick="add_attr2(this)">[+]</e>';
                                  //其他的下拉列表则显示[-]
                              }else{
                                  s+='<e class="STYLE19" onclick="$(this).parent().parent().parent().remove()">[-]</e>';
                              }
                                  s+='<span class="STYLE19">'+v.attr_name+'：</span></div></td> <td height="20" bgcolor="#FFFFFF" class="STYLE19"> <div align="left">';
                              //循环下拉列表
                                  s+='<select name="attr_info['+v.attr_id+'][]"><option value="0">-请选择-</option>';
                                  var xuan_values=v.attr_vals.split(',');
                              console.log(xuan_values);
                                  for(var i=0;i<xuan_values.length;i++){
                                      s+='<option value="'+xuan_values[i]+'"';
                                      //如果用户所设置的值与本来的值相等，则选中
                                      if(now_values[k]==xuan_values[i]){
                                          s+='selected="selected"';
                                      }
                                      s+='>'+xuan_values[i]+'</option>';
                                  }
                                      s+='</select></div></td></tr>';
                          }
                      }
                  }
              });
              //删除TR
              $('#properties-tab-show tr:gt(0)').remove();
              //追加TR
              $('#properties-tab-show').append(s);
          }
      });
  }
</script>
<script>
    //点击[+]可以增加单选属性表单域
    function add_attr2(obj){
        //根据传过来的OBJ复制一个tr
        var futr=$(obj).parent().parent().parent().clone();
        //删除tr内部的e标签
        futr.find('e').remove();
        //制作一个[-]标签，当被点击后可以删除该节点
        var jiane='<e class="STYLE19" onclick="$(this).parent().parent().parent().remove()">[-]</e>';
        //将jiane追加给futr，追加在span前边作为兄弟标签
        futr.find('span').before(jiane);
        //追加futr到当前被点击的tr后边
        $(obj).parent().parent().parent().after(futr);
    }
</script>
</html>