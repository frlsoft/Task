//json qudia��JSON�ַ���ת��ΪJSON����
function json(json){
	return jQuery.parseJSON(json.replace(/[\r\n]/g,""));//ȥ���س����� ��ֹjson���ݳ����쳣
}

//����wait div

function help(arg){
	var url = base_url + "an/"+arg;
	window.showModalDialog(url,"","");	
}
$("#help").click(function(){
	help("task");
})