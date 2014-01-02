<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>远光软件项目管理信息系统</title>
</head>

<frameset rows="60,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo site_url('portal/top')?>" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
  <frameset rows="*" cols="188,*" framespacing="0" frameborder="no" border="0">
    <frame src="<?php echo site_url('portal/left')?>" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" />
    <frameset rows="73,*" cols="*">
      <frame src="<?php echo site_url('portal/right_top')?>" name="mainFrame" id="mainFrame" />
      <frame src="<?php echo site_url('portal/right')?>" name="contentFrame" id="contentFrame" />/>
    </frameset>
  </frameset>
</frameset>
<noframes><body>不支持框架
</body>
</noframes></html>
