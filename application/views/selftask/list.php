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
<link href="<?php echo base_url()?>js/table/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/tablecloth.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/prettify.css" rel="stylesheet"> 
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/table/js/jquery-1.7.2.min.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
<script language="javascript" type="text/javascript">
function in_recycle(id,obj)
{//jquery-1.7.2.min.js
	if (confirm('确定把该商品放入回收站吗？')){
    /**/
	$.ajax({
	  url: '<?php echo site_url('user/in_recycle/gid')?>'+'/'+id,
	  type: 'GET',
	 // dataType: 'html',
	  success: function(data){
		//$alertdiv.show();
	    $(obj).parents('tr:first').remove();
		data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常		
		var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象
		alert(json.message.flag);
		if(json.message.flag == "1"){
			$alertdiv.html("处理消息:成功");
		}else{
			$alertdiv.html("错误消息:" + json.message.info);
		}
		//_reset_page();
      }
	});
	//window.location.href= '<?php echo site_url('product/in_recycle/id')?>'+'/'+id;
    }
}
</script>
<style type="text/css">
#loading{
	z-index:10000000;
	padding:5px 0 5px 29px;
	background:url(../selftasl/images/blue-loading.gif) no-repeat 10px top;
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
<div class="container">
  <div class="row">
	<div class="span12" style="padding:20px 0;">        
	  <table cellspacing="1" cellpadding="3" class="tablehead" style="background:#CCC;">
	  <caption>
		<h3>个人任务面板</h3>这是您本人当日任务数据
	  </caption>
	  <thead>  
		<tr class="stathead">
		  <th class="{sorter: false}" colspan="3">基本信息</th>
		  <th class="{sorter: false}" colspan="4">计划时间</th>
		  <th class="{sorter: false}" colspan="4">实际时间</th>
		  <th class="{sorter: false}" colspan="6">操作</th>
		</tr>
		<tr class="colhead">
		  <th class="{sorter: false}">日期</th>
		  <th class="{sorter: false}">任务名称</th>
		  <th class="{sorter: false}">所属项目&nbsp;&nbsp;</th>
		  <th title="Completions" align="right">开始</th>
		  <th title="Pass attempts" align="right"><span style="color:#FF0000;">结束</span></th>
		  <th title="Passing yards" align="right">提前</th>
		  <th title="Completion percentage" align="right">滞后</th>
		  <th title="Longest pass play" align="right">开始</th>
		  <th title="Passing touchdowns" align="right">结束</th>
		  <th title="Interceptions thrown" align="right">提前</th>
		  <th title="Passer (QB) Rating" align="right">滞后</th>
		  <th title="Rushing attempts" align="right">预览</th>
		  <th title="Total rushing yards" align="right">编辑</th>
		  <th title="Average yards per carry" align="right">执行</th>
		  <th title="Longest run" align="right">人员</th>
		  <th title="Rushing touchdowns" align="right">状态</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php  foreach ($tasks as  $value){ ?>
	  <tr class="oddrow">
	  <td><?php echo date_format(date_create($value['ctime']), 'Y-m-d'); ?></td>
	  <td><?php echo $value['caption'] ?></td>
	  <td><span class="greenfont"><?php echo $orgs[$value['projectuuid']]['pname'] ?></span></td>
	  <td align="right"><?php echo date_format(date_create($value['planStime']), 'Y-m-d'); ?></td>
	  <td align="right"><?php echo date_format(date_create($value['planEtime']), 'Y-m-d'); ?></td>
	  <td align="right">11</td>
	  <td align="right">11</td>
	  <td align="right"><?php echo date_format(date_create($value['starttime']), 'Y-m-d'); ?></td>
	  <td align="right"><?php echo date_format(date_create($value['finishtime']), 'Y-m-d'); ?></td>
	  <td align="right">0</td>
	  <td align="right">123</td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16"></td>
	  <td align="right"><a href="<?php echo site_url('selftask/edit/gid/'.$value['uuid'])?>">工作</a></td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	  <td align="right"><?php echo $status[$value['status']] ?></td>
	  </tr>
	  <?php  } ?>
	  </tbody>
	  <thead>
		<tr class="colhead {sorter: false}">
		  <th colspan="16">统计</th>
		</tr>
	  </thead>
	  <tbody>
	  <tr class="evenrow"><td>1/3</td><td>&nbsp;</td>
	  <td><span class="redfont">L</span></td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  </tr>
	  </tbody></table>
	  </div>
  </div>
</div>

<script src="<?php echo base_url()?>js/table/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.metadata.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablecloth.js"></script>
</div>
<script type="text/javascript">
$("#loading").fadeOut();
  $(document).ready(function() {
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