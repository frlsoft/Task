<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>任务编辑器</title>
<link rel="stylesheet" href="<?php echo base_url()?>js/formplugin/jqtransform.css" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/formplugin/jquery.jqtransform.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/public.function.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript">
$(function(){
		$('form').jqTransform({imgPath:'js/formplugin/img/'});
	});
$(document).ready(function(){
  //创建wait div
  var $loading = $("<img/>").attr({src: base_url+"images/blue-loading.gif",alt: "Loading. Please wait."}).addClass("wait").appendTo($("body")).hide();
  $("#btnwork").click(function(){  	
	var url = <?php echo '"'.site_url('work/load/gid/').'"'?> +"/"+ $("#uuid").val()+"/finish/"+$("#finish").val();
	var refer = window.showModalDialog(url,"","");
	//refer =refer?refer:"00";
	//$("#refer").val(refer);
	//if(isReflesh == "1"){
	    //window.name = "__self";
		//window.open(window.location.href, "__self");
		//}					   
  });
  $("#finshwork").click(function(){
	if (confirm('确定要完成此任务吗？')){
	$loading.show();
	var url = "<?php echo site_url('selftask/finishTask')?>";
	//$("#uuid").val()
	$.ajax({
		url: url,
		dataType: 'html',
		type:'POST',
		data:{uuid:$("#uuid").val()},
		success:function(html){
			//$("#info").text(setRefer(html)).show().delay(100).hide(300);
			info = json(html);
			if(info.message.flag == "1"){$loading.hide();location.reload();}else{alert(info.message.info);};			
		},
		error:function(event,request, settings){
			alert(settings.description);
		}
	});
	}
  });
});
</script>
</head>

<body>
项目ID:<?php echo $tasks['projectuuid'];?><br>
dotaskUUID:<?php echo $tasks['douuid'];?><br>
<form action="post.php" method="POST">
	<div class="rowElem"><label>任务名称:</label><input name="inputtext" type="text" value="<?php echo $tasks['caption'];?>"/></div>
	<div class="rowElem"><label>计划开始时间:</label><input name="inputtext" type="text" value="<?php echo $tasks['planStime'];?>"/></div>
	<div class="rowElem"><label>计划开始时间:</label><input name="inputtext" type="text" value="<?php echo $tasks['planEtime'];?>"/></div>
	<div class="rowElem"><label>实际开始时间:</label><input name="inputtext" type="text" value="<?php echo $tasks['starttime'];?>"/></div>
	<div class="rowElem"><label>实际开始时间:</label><input name="inputtext" type="text" value="<?php echo $tasks['finishtime'];?>"/></div>
	<div class="rowElem"><label>Checkbox: </label><input type="checkbox" name="chbox" id=""></div>
	<div class="rowElem"><label>Radio :</label> 
		<input type="radio" id="" name="question" value="oui" checked ><label>oui</label>
		<input type="radio" id="" name="question" value="non" ><label>non</label></div>
	<div class="rowElem"><label>详细描述:</label> <textarea cols="40" rows="12" name="mytext"><?php echo $tasks['content'];?></textarea></div>

	<div class="rowElem">
		<label>Select :</label>
		<select name="select">
			<option value="">1&nbsp;</option>
			<option value="opt1">2&nbsp;</option>
		</select>
	</div>
	<div class="rowElem">
		<label>Select Redimentionn:</label>
		<select name="select2" >
			<option value="opt1">Big Option test line with more wordssss</option>
			<option value="opt2">Option 2</option>
			<option value="opt3">Option 3</option>
			<option value="opt4">Option 4</option>
			<option value="opt5">Option 5</option>
			<option value="opt6">Option 6</option>
			<option value="opt7">Option 7</option>
			<option value="opt8">Option 8</option>
		</select>
	</div>	
	<div class="rowElem"><label>完成:</label><input name="finshwork" type="button" id="finshwork" value="boutonbouton" /></div>
	<div class="rowElem"><label>工作项:</label><input name="btnwork" type="reset" id="btnwork" value="工作项" /></div>
	<div class="rowElem"><label>Input button:</label><input type="button" value="bouton" /></div>
			
</form>
<!--
     [id] => 5
            [uuid] => 2F1CFC6C94EC503CF22B02B3AFC5FD03
            [useruuid] => 01A21BFBDDA855247AECDF3E159CD99C
            [taskuuid] => 27971CA5372C2405F34EDAFBC3B03795
            [ctime] => 2013-12-19 13:45:26
            [starttime] => 2013-12-19 13:45:26
            [finishtime] => 
            [douuid] => B883764291F1EEE4481B67B87274D94F
            [caption] => 测试任务计划
            [projectuuid] => 6BFEDACBB139BCA1F4559F34A3C8025E
            [planStime] => 2013-12-01 08:00:00
            [planEtime] => 2013-12-09 08:00:00
            [grade] => 
            [content] => 测试任务计划
			-->
<hr>



<hr>
工具栏
<a href="javascript:void(0)" id="btnwork">工作项</a>|<a href="#">暂存</a>|<a href="#">退出</a>
<input type="hidden" name="uuid" id="uuid" value="<?php echo $tasks['uuid'];?>">
<input type="hidden" name="finish" id="finish" value="<?php echo $tasks['finishtime']?'none':'display';?>">
</body>
</html>
