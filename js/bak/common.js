// JavaScript Document
$(document).ready(function(){
	// $('form').jqTransform({imgPath:'js/formplugin/img/'});
  	 var $loadingIndicator = $("<img/>")
     .attr({
       src: base_url+"images/blue-loading.gif", 
       alt: "Loading. Please wait."
     }).addClass("wait").appendTo($("body")).hide();
	 var $hidediv = $("<div/>").addClass("divhide") .appendTo($("body")).hide();
	 var $alertdiv = $("<div/>").addClass("divalert") .appendTo($hidediv).hide();
	 $loadingIndicator.ajaxStart(function(){
	 	$(this).show();
		$hidediv.show();
	  }).ajaxStop(function(){
	  	$(this).hide();
	  }).ajaxError(function(event,request,settings){
	  	$alertdiv.show().html("访问的页面:" + settings.url + "不存在");
	  });
	  $alertdiv.dblclick(function(){
	  	$(this).hide();
		$hidediv.hide();
		$loadingIndicator.hide();
	  });
	  
  $("#save").click(function() {//新增															
   	$.post($("#doAction").val(), $("#form1").serialize(),function(data){	
	//{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("错误消息:" + data);
	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象	
		if(json.message.flag == "1"){
			$('#form1')[0].reset();
			$alertdiv.html("处理消息:成功");
		}else{
			$alertdiv.html("错误消息:" + json.message.info);
		}
	  });
  });

  $("#btnlogin").click(function() {//登陆
   	$.post($("#doAction").val(), $('#flogin').serialize(),function(data){
	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象
		  if(json.message.flag=="1"){			  
			  $alertdiv.html("登陆成功,初始化数据中");
			  $(this).delay(8000);
			  window.location.href = site_url;//"<?php echo site_url('frameset')?>";			  
		  }else{
			  $alertdiv.html("错误消息:" + json.message.info);
		  }
	  });
  });
  $("#btnreset").click(function(){
	$('#flogin')[0].reset();
	});
});