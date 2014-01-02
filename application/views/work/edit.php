<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>工作项目编辑器</title>
<link href="<?php echo base_url()?>css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
<style type="text/css">
#loading{
	z-index:10000000;
	padding:5px 0 5px 29px;
	background:url(images/blue-loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:90px;
	position:fixed; 
	height:21px;
}
</style>
</head>

<body>
<?php echo $uuid;?><br>
<label for="content">工作说明:</label>
<form name="form1" id="form1" method="post" action="<?php echo site_url('work/save')?>">  
  <textarea name="content" id="content"></textarea>
  <input name="save" type="button" id="save" value="保存">
  <input name="gid" type="hidden" id="gid" value="">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('work/save')?>">
  <input type="hidden" name="uuid" id="uuid" value="<?php echo $uuid;?>">
  <input type="submit" name="Submit" value="提交">
</form>
</body>
</html>
