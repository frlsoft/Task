<?php
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>任务抽取</title>
<link href="<?php echo base_url()?>css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/table/js/jquery-1.7.2.min.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
var $loading = $("<img/>").attr({src: base_url+"images/blue-loading.gif",alt: "Loading. Please wait."}).addClass("wait").appendTo($("body")).hide();
	$("#extract").click(function(){
		if (confirm('确定启动抽取任务吗,抽取过程中禁止刷新页面？')){
		$loading.show();
		$(this).attr("disabled",true);
		var url = "<?php echo site_url('exttask/manualExtract')?>";
		//$("#uuid").val()
		$.ajax({
			url: url,
			dataType: 'html',
			type:'POST',
			data:{},
			success:function(html){
			$loading.hide();
			$(this).attr("disabled","");
			return;
				info = json(html);
				if(info.message.flag == "1"){$loading.hide();
				$(this).attr("disabled",false);
				}else{alert(info.message.info);};
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
<input name="extract" type="button" id="extract" value="手动抽取">
<input name="extractclost" type="button" id="extractclost" value="手动关闭">
</body>
</html>
