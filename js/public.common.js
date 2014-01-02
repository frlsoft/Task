//json qudia由JSON字符串转换为JSON对象
$(document).ready(function(){
	//ajax 调用遮罩
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
	  	$alertdiv.show().html("访问的页面:" + settings.url + "不存在");
	  });
	  $alertdiv.dblclick(function(){
	  	$(this).hide();
		$hidediv.hide();
		$loadingIndicator.hide();
	  });
	  
  //调用任务用户窗口
  $("#btnuser").click(function(){
	var url = site_url + "/task/taskUser/gid" +"/"+ $("#refer").val();
	//window.prompt("数据:",url);
	var refer = window.showModalDialog(url,"","");
	refer =refer?refer:"00";
	$("#refer").val(refer);
	//if(isReflesh == "1"){
	    //window.name = "__self";
		//window.open(window.location.href, "__self");
		//}							
				   
  });

var postdata = $("#formview").Validform({tiptype:2});
$("#save").click(function(){//新增
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

$("#save1").click(function(){//新增
	editor.sync();
	var content =  $('#content').val(); 
	postdata.ajaxPost();
	return false;
	  
    $("#tcontent").val(content);
    // alert($("#formview").serialize());
	$.post($("#doAction").val(), $("#formview").serialize(),function(data){
	//{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("错误消息:" + data);
	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
	$alertdiv.show();
	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象	
	if(json.message.flag == "1"){
		$('#formview')[0].reset();
		$alertdiv.html("处理消息:成功");
	}else{
		$alertdiv.html("错误消息:" + json.message.info);
	}
	});
});
//结束
});