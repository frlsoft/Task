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
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/Calendar.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
  $("#btnuser").click(function(){  	
	var url = <?php echo '"'.site_url('task/taskUser/gid/').'"'?> +"/"+ $("#refer").val();
	//alert(url);
	var refer = window.showModalDialog(url,"","");
	refer =refer?refer:"00";
	$("#refer").val(refer);
	//if(isReflesh == "1"){
	    //window.name = "__self";
		//window.open(window.location.href, "__self");
		//}					   
  });
});
</script>
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
<title>任务工作区</title>
</head>

<body>
<!--
   id                   int not null auto_increment,
   uuid                 varchar(50) comment '定义自主键',
   caption              varchar(50) comment '简要描述',
   projectuuid          varchar(50) comment '所属项目uuid',
   planStime            datetime comment '计划开始时间',
   planEtime            datetime comment '计划结束时间',
   grade                varchar(50) comment '任务等级',
   content              text comment '任务内容',
   primary key (id)
-->
<div id="loading">Loading... ...</div>
<div id="basic-div" class="tab-div" style="display:block">
<form name="form1" id="form1" method="post" action="<?php echo site_url('task/save');?>">
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">任务名名:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="caption" id="caption" type="text" value="<?php echo $editing['caption'];?>" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>
  
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">所属项目:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <select name="projectuuid">
  <?php foreach($projects as $value) :  ?>
	   <option value='<?php echo $value['uuid'];  ?>' <?php  if($value['GID']==$editing['projectuuid']) echo 'selected=selected'?>  ><?php echo $value['pname'];  ?></option>
  <?php endforeach; ?>
  </select>  
  </div>
  <div class="x-form-clear-left"></div>
  </div>

  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">计划开始时间:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="planStime" id="planStime" type="text" value="<?php echo $editing['planEtime'];?>" onClick="setDayHM(this);">
  </div>
  <div class="x-form-clear-left"></div>
  </div>  

  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">计划结束时间:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="planEtime" id="planEtime" type="text" value="<?php echo $editing['planEtime'];?>" onClick="setDayHM(this);">
  </div>
  <div class="x-form-clear-left"></div>
  </div>  
  
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">任务说明:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="content" id="content" type="text" value="<?php echo $editing['content'];?>" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>  
  
  <div class="x-form-item" >
  <label  style="width: 75px;color:dimgray;" class="x-form-item-label">任务执行人:</label>
  <div class="x-form-element"  style="padding-left: 80px;">
  <input name="btnuser" type="button" id="btnuser" value="选择任务接收人" >
  </div>
  <div class="x-form-clear-left"></div>
  </div>
  
  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['uuid'];?>">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('task/save')?>">
  <input name="userlist" type="hidden" id="userlist" value=""><!--用户任务分配表ID-->
  <input name="root" type="hidden" id="root" value="<?php echo $editing['root']?$editing['root']:'11';?>"><!--节点ID形成统计关系-->
  <input name="addNew" type="hidden" id="addNew" value="1"><!---->
  <input name="refer" type="hidden" id="refer" value="<?php echo $editing['refer']?$editing['refer']:'00';?>"><!--关联ID-->
  <input type="submit" name="Submit" value="提交">
  <input name="save" type="button" id="save" value="保存">
</form>
</div>
<script type="text/javascript">
$("#loading").fadeOut()
</script>
</body>
</html>