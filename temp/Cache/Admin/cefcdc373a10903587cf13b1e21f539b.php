<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>影片采集管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/admin_footer.js"></script>
<style>
.submit{cursor:pointer; height:23px; padding-top:2px;}
.actor{color:#999; width:300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; float:right}
</style>
</head>
<body>
<!--背景灰色变暗-->
<div id="showbg" style="position:absolute;left:0px;top:0px;filter:Alpha(Opacity=0);opacity:0.0;background-color:#fff;z-index:8;"></div>
<!--绑定分类表单框-->
<div id="setbind" style="position:absolute;display:none;background: #85BFDC;padding:4px 5px 5px 5px;z-index:9;"></div>
<form action="?s=Admin/Collect/Gxcms" method="post" name="gxform" id="gxform">{__NOTOKEN__}
<table width="99%" border="0" cellpadding="5" cellspacing="1" class="table">
<tr class="table_title"><td colspan="8">分类绑定设置</td></tr>
<tr class="tr"><?php if(is_array($list_class)): $i = 0; $__LIST__ = $list_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><?php if($i != 1 and $i%8 == 1): ?></tr><tr class="tr"><?php endif; ?>
<td><a href="?s=Admin/Collect/Gxcms/ziyuan/<?php echo ($ziyuan); ?>/fid/<?php echo ($fid); ?>/xmlurl/<?php echo ($xmlurl); ?>/reurl/<?php echo ($reurl); ?>/play/<?php echo ($play); ?>/inputer/<?php echo ($inputer); ?>/cid/<?php echo ($gxcms["cid"]); ?>/wd/<?php echo ($wd); ?>"><?php echo ($gxcms["cname"]); ?></a> <a href="javascript:void(0)" onClick="setbind(event,'<?php echo ($gxcms["cid"]); ?>','<?php echo ($gxcms["bind_id"]); ?>');" id="bind_<?php echo ($gxcms["bind_id"]); ?>"><?php if(getbindval($gxcms['bind_id']) > 0): ?><font color="green">已绑定</font><?php else: ?><font color="red">未绑定</font><?php endif; ?></a></td><?php endforeach; endif; else: echo "" ;endif; ?>
</tr>
<tr class="tr" style="text-align:center"><td colspan="8"><input type="button" value="全选" class="bginput" onClick="checkinput('all');"> <input type="button" value="反选" class="bginput" onClick="checkinput();"> <input type="button" value="批量采集" class="bginput" onClick="post(getjumpurl('ids','',''));" <?php if(in_array(($ziyuan), explode(',',"b"))): ?>disabled="disabled"<?php endif; ?>> <input type="button" value="采集当天" class="bginput" onClick="post(getjumpurl('day','',24));"> <?php if(!empty($cid)): ?><input type="button" value="采集本类" class="bginput" onClick="post(getjumpurl('all','<?php echo ($cid); ?>',''));"><?php endif; ?> <input type="button" value="采集所有" class="bginput" onClick="post(getjumpurl('all','',''));"> <input type="text" name="wd" id="wd" maxlength="20" value="<?php echo (urldecode($wd)); ?>" onClick="this.select();" style="color:#666666"> <input type="button" value="搜索" class="bginput" onClick="post(getjumpurl('','',''));"></td>
</tr>
</table>
<table width="99%" border="0" cellpadding="5" cellspacing="1" class="table">
  <tr align="center" class="list_head">
    <td >影片分类/影片名称/影片主演</td>
    <td width="150">更新时间</td>
  </tr>
  <?php if(is_array($list_vod)): $i = 0; $__LIST__ = $list_vod;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><tr class="tr">
    <td ><input name='ids[]' type='checkbox' value='<?php echo ($gxcms["iid"]); ?>' class="noborder" checked> [<?php echo ($gxcms["cname"]); ?>] <?php echo (htmlspecialchars($gxcms["title"])); ?> <font color="#999999"><?php echo (get_replace_html(htmlspecialchars($gxcms["intro"]),0,20,'utf-8',true)); ?></font></td>
    <td align="center" style="padding:0px"><?php echo (htmlspecialchars($gxcms["addtime"])); ?></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  <tr class="tr" style="text-align:center"><td colspan="2" class="pages"><?php echo ($pagelist); ?></td></tr>
  <tr class="tr"><td colspan="2"><input type="button" value="全选" class="bginput" onClick="checkinput('all');"> <input type="button" value="反选" class="bginput" onClick="checkinput();"> <input type="button" value="批量采集" class="bginput" onClick="post(getjumpurl('ids','',''));"> <input type="button" value="采集当天" class="bginput" onClick="post(getjumpurl('day','',24));"> <?php if(!empty($cid)): ?><input type="button" value="采集本类" class="bginput" onClick="post(getjumpurl('all','<?php echo ($cid); ?>',''));"><?php endif; ?> <input type="button" value="采集所有" class="bginput" onClick="post(getjumpurl('all','',''));"></td>
</tr>
</table>
</form>
<script language="JavaScript" charset="utf-8" type="text/javascript">
//获取跳转地址
function getjumpurl($action,$cid,$hour){
	return '?s=Admin/Collect/Gxcms/ziyuan/<?php echo ($ziyuan); ?>/fid/<?php echo ($fid); ?>/action/'+$action+'/xmlurl/<?php echo ($xmlurl); ?>/reurl/<?php echo ($reurl); ?>/vodids/<?php echo ($vodids); ?>/play/<?php echo ($play); ?>/inputer/<?php echo ($inputer); ?>/cid/'+$cid+'/wd/<?php echo ($wd); ?>/h/'+$hour;
}
//绑定分类
function setbind(event,cid,bind){
	$('#showbg').css({width:$(window).width(),height:$(window).height()});	
	var left = event.clientX+document.body.scrollLeft-70;
	var top = event.clientY+document.body.scrollTop+5;
	$.ajax({
		url: '?s=Admin/Collect/Setbind/cid/'+cid+'/bind/'+bind,
		cache: false,
		async: false,
		success: function(res){
			if(res.indexOf('status') > 0){
				alert('对不起,您没有该功能的管理权限!');
			}else{
				$("#setbind").css({left:left,top:top,display:""});			
				$("#setbind").html(res);
			}
		}
	});
}
//取消绑定
function hidebind(){
	$('#showbg').css({width:0,height:0});
	$('#setbind').hide();
}
//提交绑定分类
var submitbind = function (cid,bind){
	$.ajax({
		url: '?s=Admin/Collect/Insertbind/cid/'+cid+'/bind/'+bind,
		success: function(res){
			if(cid==''){
			$("#bind_"+bind).html(" <a href='javascript:void(0)' onClick=setbind(event,'"+cid+"','"+bind+"');><font color='red'>未绑定</font></a>");
			}else{
			$("#bind_"+bind).html(" <a href='javascript:void(0)' onClick=setbind(event,'"+cid+"','"+bind+"');>已绑定</a>");
			}
			hidebind();
		}
	});	
}
//全选与反选
function checkinput($all){
	if($all){
		$("input[name='ids[]']").each(function(){
				this.checked = true;
		});		
	}else{
		$("input[name='ids[]']").each(function(){
			if(this.checked == false)
				this.checked = true;
			else
			   this.checked = false;
		});		
	}
}
//表单提交
function post($url){
	$('#gxform').attr('action',$url);
	$('#gxform').submit();
}
</script>
<style>
#footer, #footer a:link, #footer a:visited {
	clear:both;
	color:#0072e3;
	font:12px/1.5 Arial;
	margin-top:10px;
	text-align:center;
	white-space:nowrap;
}
</style>
<div id="footer">程序版本：<?php echo C("cms_var");?>&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2010-2011 All rights reserved</div>
<div style="display:none"><a href="http://www.youmtv.com" target="_blank">优美电影网</a>商业模板认证</div>
</body>
</html>