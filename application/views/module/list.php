<?php
$CI = get_instance();
$CI->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td style="padding-right:10px;"><div align="right">
          <table border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="60"><table width="87%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center">
                        <input type="checkbox" name="checkbox62" value="checkbox" />
                    </div></td>
                    <td class="STYLE1"><div align="center">ȫѡ</div></td>
                  </tr>
              </table></td>
              <td width="60"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo base_url()?>images/main/001.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="<?php echo site_url('module/add');?>">����</a></div></td>
                  </tr>
              </table></td>
              <td width="60"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo base_url()?>images/main/114.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center">�޸�</div></td>
                  </tr>
              </table></td>
              <td width="52"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo base_url()?>images/main/083.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center">ɾ��</div></td>
                  </tr>
              </table></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c9c9c9">
      <tr>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">ģ������</span></strong></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">����ʱ��</span></strong></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">�����˵�</span></strong></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">�����û�</span></strong></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><strong><span class="STYLE1">��ϸ</span></strong></div></td>
      </tr>
	  <?php foreach($modules as $v){?>
      <tr>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><?php echo $v['mname'];?></span></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><?php echo $v['ctime'];?></span></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><a href="<?php echo site_url('module/moduleMappingMenu/uuid/').'/'.$v['uuid'];?>">�����˵�</a></span></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center"><span class="STYLE3"><a href="<?php echo site_url('module/moduleMappingMenu/uuid/').'/'.$v['uuid'];?>">�����û�</a></span></div></td>
        <td height="22" bgcolor="#FFFFFF"><div align="center" class="STYLE5">��ϸ</div></td>
      </tr>
	  <?php }?>
    </table></td>
  </tr>
  <tr>
    <td height="35"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" height="29" nowrap="nowrap"><table width="342" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44%" class="STYLE1">��ǰҳ��1/2ҳ ÿҳ 
              <input name="textfield2" type="text" class="STYLE1" style="height:14px; width:25px;" value="15" size="5" />            </td>
            <td width="14%" class="STYLE1"><img src="<?php echo base_url()?>images/main/sz.gif" width="43" height="20" /></td>
            <td width="42%" class="STYLE1"><span class="STYLE7">�������� 15 </span></td>
          </tr>
        </table></td>
        <td width="75%" valign="top" class="STYLE1"><div align="right">
            <table width="352" height="20" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="62" height="22" valign="middle"><div align="right"><img src="<?php echo base_url()?>images/main/page_first_1.gif" width="48" height="20" /></div></td>
                <td width="50" height="22" valign="middle"><div align="right"><img src="<?php echo base_url()?>images/main/page_back_1.gif" width="55" height="20" /></div></td>
                <td width="54" height="22" valign="middle"><div align="right"><img src="<?php echo base_url()?>images/main/page_next.gif" width="58" height="20" /></div></td>
                <td width="49" height="22" valign="middle"><div align="right"><img src="<?php echo base_url()?>images/main/page_last.gif" width="52" height="20" /></div></td>
                <td width="59" height="22" valign="middle"><div align="right">ת����</div></td>
                <td width="25" height="22" valign="middle"><span class="STYLE7">
                  <input name="textfield" type="text" class="STYLE1" style="height:10px; width:25px;" size="5" />
                </span></td>
                <td width="23" height="22" valign="middle">ҳ</td>
                <td width="30" height="22" valign="middle"><img src="<?php echo base_url()?>images/main/go.gif" width="26" height="20" /></td>
              </tr>
            </table>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>