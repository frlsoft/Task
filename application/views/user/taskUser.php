<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>用户任务分配</title>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery-1.9.1.js?version=1.9.0"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery-migrate-1.1.0.js?version=1.9.0"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('label[id^="c:"]').live("click",function(){//从待选中移除加入任务分配用户表中
	/**/
	var $lable = $("<label/>")
	     .attr({id:"w:"+$(this).attr("id").split(":")[1]})
		 .text($(this).text())
		 .appendTo($("#taskuser"));
	$(this).remove();
	//同步处理数据到数据库
	var refer = $("#refer").val();
	var useruuid = $(this).attr("id").split(":")[1];
	var url = "<?php echo site_url('task/assginTask')?>" + "/flag/1"+"/useruuid/"+useruuid+"/refer/"+refer;	
	//$("#info").text(url);	
	$.ajax({
	  url: url,
	  //cache: false,
	  success: function(html){
		$("#info").text(setRefer(html)).show().delay(100).hide(300);
	  },
	  error:function(){
	  	$("#info").text(html).show();
	  }
	});
  });
  //从已分配的用户中移除到待选用户中 'label[id^="w:"]'
  $('label[id^="w:"]').live("click",function(){
	var $lable = $("<label/>")
	     .attr({id:"c:"+$(this).attr("id").split(":")[1]})
		 .text($(this).text())
		 .appendTo($("#alluser"));
	$(this).remove();
	var refer = $("#refer").val();
	var useruuid = $(this).attr("id").split(":")[1];
	var url = "<?php echo site_url('task/assginTask')?>" + "/flag/0"+"/useruuid/"+useruuid+"/refer/"+refer;	
	
	$.ajax({
	  url: url,
	  //cache: false,
	  success: function(html){
		$("#info").text(setRefer(html)).show().delay(100).hide(300);
	  },
	  error:function(){
	  	$("#info").text(html).show();
	  }
	});	
  });
}); 
function setRefer(data){
	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象
	$("#refer").val(json.message.refer);
	return json.message.info;
}
function closeWin(){
	window.returnValue = $("#refer").val();
	window.close();
}
function window.onunload(){
	window.returnValue = $("#refer").val();
}  
</script>
<style type="text/css">
#info{
	z-index:1;
	padding:5px 0 5px 29px;
	background:url(images/blue-loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:150px;
	position:fixed; 
	height:21px;
}
</style>
</head>

<body>
<div id="info" style="display:none; "></div>
<div id="alluser">
待选择用户：
<?php foreach($alluser as $k){?>
<?php if(!$taskuser[$k['GID']]){?>
<label id="c:<?php echo $k['GID'];?>">[<?php echo $k['SHOWNAME'];?>] </label><br>
<?php }?>
<?php }?>
</div>
<hr>
<form name="form1" method="post" action="">
<div id="taskuser">任务分配用户:
<?php foreach($taskuser as $v){?>
<label id="w:<?php echo $v['useruuid'];?>">[<?php echo $alluser[$v['useruuid']]['SHOWNAME'];?>]</label>
<?php }?>
<input name="refer" type="hidden" id="refer" value="<?php echo $v['refer'];?>">
</div>
</form>
</body>
</html>
