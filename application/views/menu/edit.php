<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
<title>无标题文档</title>
</head>

<body>
<div id="loading">Loading... ...</div>
<div id="basic-div" class="tab-div" style="display:block">
<form name="form1" id="form1" method="post" action="<?php echo site_url('menu/save');?>">
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">菜单名:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="NAME" id="NAME" type="text" value="<?php echo $editing['NAME'];?>" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>
  
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">url地址:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="URL" id="URL" type="text" value="<?php echo $editing['URL'];?>" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>

  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">功能描述:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="content" id="content" type="text" value="<?php echo $editing['content'];?>" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>  

  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">是否停用:</label>
  <div class="x-form-element"  style="padding-left: 80px;">  
  <input  name="yhbh" type="checkbox" class="x-form-text x-form-field " id="yhbh" style="width: 222px;" size="20" <?php echo $editing['ISSTOP']?"checked":""?>>
  </div>
  <div class="x-form-clear-left"></div>
  </div>  
  
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">是否叶子菜单:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input name="isroot" type="checkbox" id="isroot" value="checkbox" <?php echo $editing['isroot']?"checked":""?>>
  </div>
  <div class="x-form-clear-left"></div>
  </div>
  
  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['UID'];?>">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('menu/save')?>">
  <input type="submit" name="Submit" value="提交">
  <input name="save" type="button" id="save" value="按钮">
</form>
</div>
<script type="text/javascript">
$("#loading").fadeOut()
</script>
</body>
</html>