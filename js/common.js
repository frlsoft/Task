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
	  	$alertdiv.show().html("���ʵ�ҳ��:" + settings.url + "������");
	  });
	  $alertdiv.dblclick(function(){
	  	$(this).hide();
		$hidediv.hide();
		$loadingIndicator.hide();
	  });
	  
  $("#save").click(function() {//����															
   	$.post($("#doAction").val(), $("#form1").serialize(),function(data){	
	//{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("������Ϣ:" + data);
	data = data.replace(/[\r\n]/g,"")//ȥ���س����� ��ֹjson���ݳ����쳣
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//��JSON�ַ���ת��ΪJSON����	
		if(json.message.flag == "1"){
			$('#form1')[0].reset();
			$alertdiv.html("������Ϣ:�ɹ�");
		}else{
			$alertdiv.html("������Ϣ:" + json.message.info);
		}
	  });
  });

  $("#btnlogin").click(function() {//��½
   	$.post($("#doAction").val(), $('#flogin').serialize(),function(data){
	data = data.replace(/[\r\n]/g,"")//ȥ���س����� ��ֹjson���ݳ����쳣
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//��JSON�ַ���ת��ΪJSON����
		  if(json.message.flag=="1"){			  
			  $alertdiv.html("��½�ɹ�,��ʼ��������");
			  $(this).delay(8000);
			  window.location.href = site_url;//"<?php echo site_url('frameset')?>";			  
		  }else{
			  $alertdiv.html("������Ϣ:" + json.message.info);
		  }
	  });
  });
  $("#btnreset").click(function(){
	$('#flogin')[0].reset();
	});
});