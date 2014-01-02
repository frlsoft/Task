<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link href="<?php echo base_url()?>images/main/main.css" rel="stylesheet" type="text/css" />
<script language="javascript">
var base_url = <?php echo '"'.base_url().'";'?>
var site_url = "<?php echo site_url('portal/loginOut')?>";
</script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/loginout.js"></script>
</head>

<body>
     <div id="right_top">
			        <div id="img"><img src="<?php echo base_url()?>images/main/close.gif"/></div>
			        <span class="imgtext">打开/关闭左栏</span>
					<?php foreach($modules as $v){?>
					<span class="imgtext">|</span>
					<span class="imgtext"><a href="<?php echo base_url()?>index.php/portal/left/<?php echo $v['uuid'];?>" target="leftFrame"><?php echo $v['mname'];?></a></span>			
					<?php }?>
					<span class="imgtext">|</span>
					<span class="imgtext"><a href="<?php echo base_url()?>index.php/portal/left" target="leftFrame">个人信息</a></span>
			   <div id="loginout">
			        <div id="loginoutimg"><img src="<?php echo base_url()?>images/main/loginout.gif" /></div>
			        <span class="logintext">退出系统</span>	 
			   </div>			   		
			   </div>
			   <div id="right_font"><img src="<?php echo base_url()?>images/main/main_14.gif"/> 您现在所在的位置：<?php echo $location[0].$location[1].$location[2]?><span class="bfont"> </span></div>
</body>
</html>
