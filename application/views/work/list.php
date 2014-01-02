<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>work列表</title>
<link href="<?php echo base_url()?>js/table/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/tablecloth.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/prettify.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/table/js/jquery-1.7.2.min.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
  $("#addwork").click(function(){  	
	var url = <?php echo '"'.site_url('work/add/gid/').'"'?> +"/"+ $("#uuid").val();
	//alert(url);
	var refer = window.showModalDialog(url,"","");
	    window.name = "__self";
		window.open(window.location.href, "__self");
  });
});
</script>
<style type="text/css">
#loading{
	z-index:10000000;
	padding:0px 0 0px 0px;
	background:url(../selftasl/images/blue-loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:90px;
	position:fixed; 
	height:21px;
}
</style>
</head>

<body>
<div id="loading">Loading... ...</div>
<div class="container">
  <div class="row">
	<div class="span12" style="padding:20px 0;">        
	  <table cellspacing="1" cellpadding="3" class="tablehead" style="background:#CCC;">
	  <caption>
		<h3>个人任务面板</h3>这是您本人当日任务数据<label id="addwork" style="display:<?php echo $finish;?> ">[添加]</label>
	  </caption>
	  <thead>  
		<tr class="stathead">
		  <th class="{sorter: false}" colspan="2">基本信息</th>
		  <th class="{sorter: false}" colspan="2">时间</th>
		  <th class="{sorter: false}" colspan="1">操作</th>
		</tr>
		<tr class="colhead">
		  <th class="{sorter: false}">序号</th>
		  <th class="{sorter: false}">内容</th>
		  <th title="Completions" align="right">开始</th>
		  <th title="Pass attempts" align="right"><span style="color:#FF0000;">结束</span></th>
		  <th title="Total rushing yards" align="right">编辑</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php foreach($works as $v){?>
	  <tr class="oddrow">
	  <td><?php echo ++$i; ?></td>
	  <td><?php echo $v['content'] ?></td>
	  <td align="right"><?php echo date_format(date_create($v['stime']), 'Y-m-d'); ?></td>
	  <td align="right"><?php echo date_format(date_create($v['ftime']), 'Y-m-d'); ?></td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"><a href="<?php echo site_url('selftask/edit/gid/'.$v['uuid'])?>">工作</a></td>
	  </tr>
	  <?php  } ?>
	  </tbody>
	  </table>
	  </div>
  </div>
</div>
<input type="hidden" name="uuid" id="uuid" value="<?php echo $uuid;?>">
<script src="<?php echo base_url()?>js/table/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.metadata.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablecloth.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#loading").fadeOut();
	$("table").tablecloth({
	  theme: "paper",
	  striped: true,
	  sortable: true,
	  condensed: true
	});
  });
</script>
</body>
</html>