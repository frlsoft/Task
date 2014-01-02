<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url()?>images/login/login.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css')?>" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/Validform_v5.3.2.js?version=5.3.2"></script>
<script language="javascript">
var base_url = <?php echo '"'.base_url().'";'?>
var site_url = "<?php echo site_url('portal/main')?>";
$(document).keypress(function(e) {
if (e.which == 13){
	$("#btnlogin").click();
	}
});
$(document).ready(function(){
	//数据验证
	$("#flogin").Validform({
		btnSubmit:"#btnlogin",
		tiptype:3,
		beforeSubmit:function(curform){
		$.post($('#flogin').attr('action'), $('#flogin').serialize(),function(data){
		data = data.replace(/[\r\n]/g,"")//去掉回车换行 防止json数据出现异常
		var json = jQuery.parseJSON(data);//由JSON字符串转换为JSON对象
		  if(json.message.flag=="1"){			  
			 // $alertdiv.html("登陆成功,初始化数据中");
			  $(this).delay(8000);
			  window.location.href = site_url;//"<?php echo site_url('frameset')?>";			  
		  }else{
		  		alert("错误消息:" + json.message.info);
			 // $alertdiv.html("错误消息:" + json.message.info);
		  }
	  	});
			return false;
		}
	
	});
	//提交表单
	$("#btnlogin").bind("click",function(){

	});
});
</script>
<style type="text/css">
#loading{
	z-index:1;
	padding:0px 0 0px 0px;
	background:url(images/loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:184px;
	position:fixed; 
	height:48px;
}
</style>
</head>
<body>
<div id="loading"></div>
<form name="flogin" id="flogin" method="post" action="<?php echo site_url('portal/init');?>">
    <div id="login">
	     <div id="top">
		      <div id="top_left"><img src="<?php echo base_url()?>images/login/login_03.gif" /></div>
			  <div id="top_center"></div>
		 </div>
		 <div id="center">
		      <div id="center_left"></div>
			  <div id="center_middle">
			       <div id="user">用   户
			         <input datatype="*" errormsg="用户名不能为空！" name="username" type="text" id="username" class="gray intxt" tip="请输入用户名" altercss="gray"/>
			      	 <div class="Validform_checktip"></div>
			       </div>
				   <div id="password">密   码
				     <input datatype="*" errormsg="用密码不能为空！" name="upassword" type="password" id="upassword"/>
				     <div class="Validform_checktip"></div>
				   </div>
				   <div id="btn"><span id="btnlogin">登录</span><span id="btnreset">清空</span></div>
			  </div>
			  <div id="center_right"></div>		 
		 </div>
		 <div id="down">
		      <div id="down_left">
			      <div id="inf">
                       <span class="inf_text">版本信息</span>
					   <span class="copyright">管理信息系统 2013 v1.5</span>
			      </div>
			  </div>
			  <div id="down_center"></div>		 
		 </div>
	</div>
</form>
<script type="text/javascript">
$("#loading").fadeOut()
</script>
</body>
</html>