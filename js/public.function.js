//json qudia由JSON字符串转换为JSON对象
function json(json){
	return jQuery.parseJSON(json.replace(/[\r\n]/g,""));//去掉回车换行 防止json数据出现异常
}

//创建wait div

function help(arg){
	var url = base_url + "an/"+arg;
	window.showModalDialog(url,"","");	
}
$("#help").click(function(){
	help("task");
})