<?php
$CI = get_instance ();
$CI->load->helper ( 'url' );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/MzTreeView10.js"></script>
<title>�ޱ����ĵ�</title>
</head>

<body>
<a href="addRole">��ӽ�ɫ</a>
<?php 
foreach ($roles as $role){
	echo $role['RNAME'].'</br>';
}
?>
</body>
</html>
