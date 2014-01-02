<?php
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta charset="utf-8" />
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css')?>" />
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript">var site_url = <?php echo '"'.site_url().'";'?></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.9.1.min.js?version=1.9.0"></script>
<!--
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-migrate-1.1.0.js?version=1.9.0"></script>
-->
<script type="text/javascript" src="<?php echo base_url()?>js/datejs/WdatePicker.js?version=1.9.0"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/kindeditor-min.js" charset="utf-8" ></script>
<script type="text/javascript" src="<?php echo base_url()?>js/lang/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/Validform_v5.3.2.js?version=5.3.2"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/public.common.valid.js" charset="utf-8"></script>
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
