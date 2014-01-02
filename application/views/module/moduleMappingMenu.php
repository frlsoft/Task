<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>模块与菜单对应</title>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){

})
</script>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
.STYLE3 {color: #707070; font-size: 12px; }
.STYLE5 {color: #0a6e0c; font-size: 12px; }
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
.STYLE7 {font-size: 12}
-->
</style>
</head>

<body>
<form name="form1" id="form1" method="post" action="<?php echo site_url('module/savemoduleMappingMenu')?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td style="padding-right:10px;"><div align="right"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c9c9c9">
      <tr>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">系统菜单</span></strong></div></td>
		<td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">模块菜单</span></strong></div></td>
      </tr>
	  
      <tr>
        <td height="22" bgcolor="#FFFFFF">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		   <tr>
			 <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">菜单名称:</span></strong></div></td>
			 <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">URL地址:</span></strong></div></td>
			 <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">功能描述:</span></strong></div></td>
		   </tr>
		  <?php foreach($allmenus as $v){?>	  
            <tr>
              <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3">
			  <?php $checked = $menus[$v['UID']]?"checked = 'checked'":"";?>
                  <input name="menuid[]" type="checkbox" id="menuid[]" value="<?php echo $v['UID'];?>" <?php echo $checked;?> />
                  <?php echo $v['NAME'];?>     
</span></div></td>
              <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><?php echo $v['URL']?></span></div></td>
              <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><?php echo $v['content']?></span></div></td>
            </tr>
		 <?php }?>
          </table>
        </td>
		<td height="22" bgcolor="#FFFFFF">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">		 
          <?php foreach($menus as $v){?>	  
            <tr>
              <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3">
				  <?php echo $v['NAME'];?>
              </span></div></td>
            </tr>
		  <?php }?>		 
          </table>
        </td>
      </tr>
	  
    </table></td>
  </tr>
  <tr>
    <td height="35"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" height="29" nowrap="nowrap"><table width="342" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44%" class="STYLE1">&nbsp;</td>
            <td width="14%" class="STYLE1"><input type="submit" name="Submit" value="提交" /></td>
            <td width="42%" class="STYLE1">&nbsp;</td>
          </tr>
        </table></td>
        <td width="75%" valign="top" class="STYLE1"><div align="right">
            </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<input name="gid" type="hidden" id="gid" value="<?php echo $gid;?>" />
<input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('module/savemoduleMappingMenu')?>" />
</form>
</body>
</html>
