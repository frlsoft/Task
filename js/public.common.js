//json qudia��JSON�ַ���ת��ΪJSON����
$(document).ready(function(){
	//ajax ��������
  	 var $loadingIndicator = $("<img/>")
     .attr({
       src: base_url+"images/blue-loading.gif", 
       alt: "Loading. Please wait."
     }).addClass("wait").appendTo($("body")).hide();
	 var $hidediv = $("<div/>").addClass("divhide") .appendTo($("body")).hide();
	 var $alertdiv = $("<div/>").addClass("divalert") .appendTo($("body")).hide();
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
	  
  //���������û�����
  $("#btnuser").click(function(){
	var url = site_url + "/task/taskUser/gid" +"/"+ $("#refer").val();
	//window.prompt("����:",url);
	var refer = window.showModalDialog(url,"","");
	refer =refer?refer:"00";
	$("#refer").val(refer);
	//if(isReflesh == "1"){
	    //window.name = "__self";
		//window.open(window.location.href, "__self");
		//}							
				   
  });

var postdata = $("#formview").Validform({tiptype:2});
$("#save").click(function(){//����
	editor.sync();
	var content =  $('#content').val(); 
	$("#tcontent").val(content);
	var obj = $("#formview").serialize();
	postdata.config({
		showAllError:true,
		// url:$("#doAction").val(),
		url:"http://www.baidu.com",
		ajaxpost:{			
			//timeout:30000,
			success:function(data,obj){
				alert(data);
			},
			error:function(data,obj){
				alert(data.status);
			}
		}
	});
	
});

$("#save1").click(function(){//����
	editor.sync();
	var content =  $('#content').val(); 
	postdata.ajaxPost();
	return false;
	  
    $("#tcontent").val(content);
    // alert($("#formview").serialize());
	$.post($("#doAction").val(), $("#formview").serialize(),function(data){
	//{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("������Ϣ:" + data);
	data = data.replace(/[\r\n]/g,"")//ȥ���س����� ��ֹjson���ݳ����쳣
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//��JSON�ַ���ת��ΪJSON����	
	if(json.message.flag == "1"){
		$('#formview')[0].reset();
		$alertdiv.html("������Ϣ:�ɹ�");
	}else{
		$alertdiv.html("������Ϣ:" + json.message.info);
	}
	});
});
//����
});