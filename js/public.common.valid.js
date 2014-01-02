
$(document).ready(function(){
	//ajax 调用遮罩
  	 var $loadingIndicator = $("<img/>")
     .attr({
       src: base_url+"images/blue-loading.gif", 
       alt: "Loading. Please wait."
     }).addClass("wait").appendTo($("body")).hide();
	 var $hidediv = $("<div/>").addClass("divhide") .appendTo($("body")).hide();
	 var $alertdiv = $("<div/>").addClass("divalert") .appendTo($("body")).hide();
	 // $loadingIndicator.ajaxStart(function(){
	 // 	$(this).show();
		// $hidediv.show();
	 //  }).ajaxStop(function(){
	 //  	$(this).hide();
	 //  }).ajaxError(function(event,request,settings){
	 //  	$alertdiv.show().html("访问的页面:" + settings.url + "不存在");
	 //  });
	  $alertdiv.dblclick(function(){
	  	$(this).hide();
		$hidediv.hide();
		$loadingIndicator.hide();
	  });

	KindEditor.ready(function(K){window.editor = K.create('#content');});
	$("#formview").Validform({//$(".demoform")指明是哪一表单需要验证,名称需加在form表单上;
		btnSubmit:"#save", //#btn_sub是该表单下要绑定点击提交表单事件的按钮;如果form内含有submit按钮该参数可省略;
		//btnReset:".btn_reset",//可选项 .btn_reset是该表单下要绑定点击重置表单事件的按钮;
		tiptype:2, //可选项 1=>pop box,2=>side tip(parent.next.find; with default pop),3=>side tip(siblings; with default pop),4=>side tip(siblings; none pop)，默认为1，也可以传入一个function函数，自定义提示信息的显示方式（可以实现你想要的任何效果，具体参见demo页）;
		ignoreHidden:false,//可选项 true | false 默认为false，当为true时对:hidden的表单元素将不做验证;
		// dragonfly:false,//可选项 true | false 默认false，当为true时，值为空时不做验证；
		// tipSweep:true,//可选项 true | false 默认为false，只在表单提交时触发检测，blur事件将不会触发检测（实时验证会在后台进行，不会显示检测结果）;
		// label:".label",//可选项 选择符，在没有绑定nullmsg时查找要显示的提示文字，默认查找".Validform_label"下的文字;
		showAllError:false,//可选项 true | false，true：提交表单时所有错误提示信息都会显示，false：一碰到验证不通过的就停止检测后面的元素，只显示该元素的错误信息;
		postonce:true, //可选项 表单是否只能提交一次，true开启，不填则默认关闭;
		ajaxPost:true, //使用ajax方式提交表单数据，默认false，提交地址就是action指定地址;
		// datatype:{//传入自定义datatype类型，可以是正则，也可以是函数（函数内会传入一个参数）;
		// 	"*6-20": /^[^\s]{6,20}$/,
		// 	"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
		// 	"username":function(gets,obj,curform,regxp){
		// 		//参数gets是获取到的表单元素值，obj为当前表单元素，curform为当前验证的表单，regxp为内置的一些正则表达式的引用;
		// 		var reg1=/^[\w\.]{4,16}$/,
		// 			reg2=/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;
				
		// 		if(reg1.test(gets)){return true;}
		// 		if(reg2.test(gets)){return true;}
		// 		return false;
				
		// 		//注意return可以返回true 或 false 或 字符串文字，true表示验证通过，返回字符串表示验证失败，字符串作为错误提示显示，返回false则用errmsg或默认的错误提示;
		// 	},
		// 	"phone":function(){
		// 		// 5.0 版本之后，要实现二选一的验证效果，datatype 的名称 不 需要以 "option_" 开头;	
		// 	}
		// },
		// usePlugin:{
		// 	swfupload:{},
		// 	datepicker:{},
		// 	passwordstrength:{},
		// 	jqtransform:{
		// 		selector:"select,input"
		// 	}
		// },
		beforeCheck:function(curform){
			//$alertdiv.show();
			editor.sync();
			//alert(curform);
			//在表单提交执行验证之前执行的函数，curform参数是当前表单对象。
			//这里明确return false的话将不会继续执行验证操作;	
		},
		beforeSubmit:function(curform){
			// $loadingIndicator.show();
			// $hidediv.show();
			// var content =  $('#content').val();
			// $("#tcontent").val(content);
			// $.post($("#doAction").val(), $(curform).serialize(),function(data){
			// 	//{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("错误消息:" + data);
			// 	$alertdiv.show();
			// 	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
			// 	//$alertdiv.show();
			// 	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象	
			// 	if(json.message.flag == "1"){
			// 		$alertdiv.html("处理消息:成功");
			// 		$('#formview')[0].reset();
			// 	}else{
			// 		$alertdiv.html("错误消息:" + json.message.info);
			// 	}
			// });
			//editor.sync();
			var content =  $('#content').val();
			$("#tcontent").val(content);
			$.post($('#formview').attr('action'), $("#formview").serialize(),function(data){
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
			return false;
			//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
			//这里明确return false的话表单将不会提交;
		},
		callback:function(data){
			alert(data);
			//返回数据data是json格式，{"info":"demo info","status":"y"}
			//info: 输出提示信息;
			//status: 返回提交数据的状态,是否提交成功。如可以用"y"表示提交成功，"n"表示提交失败，在ajax_post.php文件返回数据里自定字符，主要用在callback函数里根据该值执行相应的回调操作;
			//你也可以在ajax_post.php文件返回更多信息在这里获取，进行相应操作；
			//ajax遇到服务端错误时也会执行回调，这时的data是{ status:**, statusText:**, readyState:**, responseText:** }；
			
			//这里执行回调操作;
			//注意：如果不是ajax方式提交表单，传入callback，这时data参数是当前表单对象，回调函数会在表单验证全部通过后执行，然后判断是否提交表单，如果callback里明确return false，则表单不会提交，如果return true或没有return，则会提交表单。
		}
	});

	//保存按钮
	$("#save").click(function(){
		// editor.sync();
		// var content =  $('#content').val();
		// $("#tcontent").val(content);
		// $.post($('#formview').attr('action'), $("#formview").serialize(),function(data){
		//     //{"message":{"flag":"0","info":"<div class="error">data erroe</div><div class="error">data erroe</div>"}}//$alertdiv.html("错误消息:" + data);
		// 	data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
		// 	$alertdiv.show();
		// 	var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象
		// 	if(json.message.flag == "1"){
		// 		$('#formview')[0].reset();
		// 		$alertdiv.html("处理消息:成功");
		// 	}else{
		// 		$alertdiv.html("错误消息:" + json.message.info);
		// 	}		
		// });
	});

	//打开模式窗口
	$("#btnuser").click(function(){
	var url = site_url + "/task/taskUser/gid/"+ $("#refer").val();
	var refer = window.showModalDialog(url,"","");
	refer =refer?refer:"00";
	$("#refer").val(refer);
	//if(isReflesh == "1"){
	//window.name = "__self";
	//window.open(window.location.href, "__self");
	//}					   
	});	
});