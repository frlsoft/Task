// JavaScript Document
$(document).ready(function(){
	var $hidediv = $("<div/>").addClass("divhide") .appendTo($("body")).hide();
	$("#loginoutimg").click(function() {//��½
		if (confirm('ȷ��Ҫ�˳�ϵͳ��')){
			// $(this).delay(8000);
			$.ajax({
				type:"POST",
				url:site_url,
				data:"",
				success:function(data){
					window.opener=null;
					window.close();
					window.parent.location.href = base_url;//"<?php echo site_url('frameset')?>";
					//window.top.framename.location.href = url;window.parent.location.href=url;mainframe.location.href=url;
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					$hidediv.html(XMLHttpRequest.responseText);
					$hidediv.show();
				}
			});
		}
	});
});