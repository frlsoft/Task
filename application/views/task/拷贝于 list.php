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
<!-- 内容 -->
<div style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" id="content" class="x-panel-body" >
<div class="list-div " id="listDiv" style="margin-bottom:0px;overflow:auto">	      
  <table cellpadding="3" cellspacing="0" id="listTable" >		  
  <thead>
  <tr class="x-grid3-header">
	<th class="sort-numeric " >
	<div class="x-grid3-hd-inner ">任务名称<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

	<th class="sort-alpha" >
	<div class="x-grid3-hd-inner">计划开始时间<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

	<th class="sort-alpha">
	<div class="x-grid3-hd-inner">计划结束时间<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

	<th class="sort-alpha">
	<div class="x-grid3-hd-inner">任务用户<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >
	
	<th class="sort-alpha">
	<div class="x-grid3-hd-inner">任务描述<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

	<th class="sort-numeric ">
	<div class="x-grid3-hd-inner">所属项目<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th >

	<th>
	<div class="x-grid3-hd-inner">操作</div></th >
  </tr>
  </thead>
  <tbody>
  <?php  foreach ($tasks as  $value){ ?>
  <tr class="x-grid3-row " >
  <!--
                      [id] => 12
                    [uuid] => FCFEA13DBE13202830DC991CF589FDB0
                    [caption] => 测试i程序
                    [projectuuid] => 6BFEDACBB139BCA1F4559F34A3C8025E
                    [planStime] => 2013-12-01 08:00:00
                    [planEtime] => 2013-12-24 08:00:00
                    [grade] => 
                    [content] => 测试i程序
                    [refer] => 

  -->
	<td><div class="x-grid3-cell-inner"><?php echo $value['caption'] ?></div></td>
	<td><div class="x-grid3-cell-inner" ><?php echo $value['planStime']; ?></div></td>
	<td><div class="x-grid3-cell-inner"><?php echo $value['planEtime'] ?></div></td>
	<td><div class="x-grid3-cell-inner"><?php echo $value['refer'] ?></div></td>
	<td><div class="x-grid3-cell-inner"><?php echo $value['content'] ?></div></td>
	<td><div class="x-grid3-cell-inner"><span onclick="listEdit(this, 'price', <?php echo $value['id'] ?>)" ><?php echo $orgs[$value['projectuuid']]['pname'] ?></span></div></td>
	<td><div class="x-grid3-cell-inner">
	 <a href='<?php echo site_url('product')?>' style="text-decoration:none" alt='浏览' title='浏览'>
	 <img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16">
	 </a>&nbsp;&nbsp;
	 <a href='<?php echo site_url('task/edit/gid/'.$value['uuid'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
	 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
	 </a>&nbsp;&nbsp;
	 <a href='#' id="in_recycle" style="text-decoration:none"  title='放入回收站' onclick="in_recycle('<?php echo $value['GID']?>',this)">
	 <img src="<?php echo base_url()?>images/icon_trash.gif" border="0" width="16" height="16" alt='放入回收站'>
	 </a>
	</div></td>
  </tr>
  <?php  } ?>
</tbody></table>
</div>
<script type="text/javascript">
$("#loading").fadeOut()
</script>
</body>
</html>