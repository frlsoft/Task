<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>菜单</title>
<link href="<?php echo base_url()?>images/main/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="left">
<div id="left_menu"></div>
<div id="left_tree">
	<div id="tree_icon">
	   <div id="yh"><img src="<?php echo base_url()?>images/main/user.gif" /><?php echo $model[0]['mname'];?></div>
	   <div id="system"><img src="<?php echo base_url()?>images/main/system.gif" />系统管理</div>
	</div>
	<div id="tree_text">
	<?php foreach($menus as $m){?>
		 <li class="tree_li"><span class="list_img"><img src="<?php echo base_url()?>images/main/list_img.gif" /></span><a <a href="<?php echo base_url()?>index.php/<?php echo $m['URL']; ?>" target="contentFrame"><?php echo $m['NAME'];?></a></li>
	<?php }?>
	</div>
</div>
<div id="tree_down"></div>
</body>
</html>
