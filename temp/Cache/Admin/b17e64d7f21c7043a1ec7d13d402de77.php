<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>模板管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' type='text/css' href='./views/css/admin_style.css'>
<script language="JavaScript" charset="utf-8" type="text/javascript" src="./views/js/jquery.js"></script>
</head>
<body>
<table width="98%" border="0" cellpadding="4" cellspacing="1" class="table">
<tr class="table_title"><td colspan="5">网站模板管理</td></tr>
<tr class="list_head ct">
  <td >文件名</td>
  <td width="150">文件描述</td>
  <td width="100">文件大小</td>
  <td width="150">修改时间</td>
  <td width="100">操作</td>
</tr>
<?php if(!empty($dirup)): ?><tr class="tr">
<td colspan="5"><img src="./views/images/file/folder.png"> <a href="?s=Admin/Tpl/Show/id/<?php echo ($dirup); ?>" >上级目录</a> 当前目录: <?php echo ($dirpath); ?></td>
</tr><?php endif; ?> 
<?php if(is_array($dir)): $i = 0; $__LIST__ = $dir;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gxcms): ++$i;$mod = ($i % 2 )?><?php if(($gxcms["isDir"])  ==  "1"): ?><tr class="tr">
<td ><img src="./views/images/file/folder.png"> <a href="?s=Admin/Tpl/Show/id/<?php echo str_replace('/','*',$gxcms['path'].'/'.$gxcms['filename']);?>" ><?php echo ($gxcms["filename"]); ?></a></td>
<td class="td ct">文件夹</td>
<td class="td ct"><?php echo byte_format(getdirsize($gxcms['path'].'/'.$gxcms['filename']));?></td>
<td class="td ct"><?php echo (get_color_date('Y-m-d H:i:s',$gxcms["mtime"])); ?></td>
<td class="td ct"><a href="?s=Admin/Tpl/Show/id/<?php echo str_replace('/','*',$gxcms['path'].'/'.$gxcms['filename']);?>">下级目录</a></td>
</tr>
<?php else: ?>
<tr class="tr">
<td ><img src="./views/images/file/<?php echo (($gxcms["ext"])?($gxcms["ext"]):'other'); ?>.png"> <?php echo ($gxcms["filename"]); ?></td>
<td class="td ct"><?php echo (get_tpl_name($gxcms["filename"])); ?></td>
<td class="td ct"><?php echo (byte_format($gxcms["size"])); ?></td>
<td class="td ct"><?php echo (get_color_date('Y-m-d H:i:s',$gxcms["mtime"])); ?></td>
<?php if(ereg(".html|.txt|.css|.php|.js",$gxcms['filename'])){ ?>
<td class="td ct"><a href="?s=Admin/Tpl/Add/id/<?php echo str_replace('/','*',str_replace('.'.$gxcms['ext'],'@'.$gxcms['ext'],$gxcms['path'].'/'.$gxcms['filename']));?>">编辑</a> <a href="?s=Admin/Tpl/Del/id/<?php echo str_replace('/','*',str_replace('.'.$gxcms['ext'],'@'.$gxcms['ext'],$gxcms['path'].'/'.$gxcms['filename']));?>" onClick="return confirm('确定删除该文件吗?')">删除</a> <?php if(!empty($mytpl)): ?><a href="?s=admin/html/mytpl/id/<?php echo ($gxcms['filename']); ?>">生成</a><?php endif; ?></td>
<?php }else{ ?>
<td width="125" class="td ct"><a href="<?php echo ($gxcms["path"]); ?>/<?php echo ($gxcms["filename"]); ?>" target="_blank">浏览</a> <a href="?s=Admin/Tpl/Del/id/<?php echo ($gxcms["filename"]); ?>" onClick="return confirm('确定删除该文件吗?')">删除</a></td>
<?php } ?>
</tr><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
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