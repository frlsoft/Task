<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
<link href="<?php echo base_url()?>images/main/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="top">
	      <div id="logo"></div>
		  <div id="user">��ӭ��:<?php echo $userdata['ORGNAME'].'-'.$userdata['SHOWNAME'].'  IP:'.$userdata['ip_address']?></div>	 
	 </div>
</body>
</html>
