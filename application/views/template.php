<?php
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
<link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css')?>" />
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript">var site_url = <?php echo '"'.site_url().'";'?></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.9.1.min.js?version=1.9.0"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/datejs/WdatePicker.js?version=1.9.0"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/public.common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/kindeditor-min.js" charset="utf-8" ></script>
<script type="text/javascript" src="<?php echo base_url()?>js/lang/zh_CN.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/Validform_v5.3.2.js?version=5.3.2" charset="utf-8"></script>
<style type="text/css">
#loading{
	z-index:10000000;
	padding:5px 0 5px 29px;
	background:url(images/blue-loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:90px;
	position:fixed; 
	height:21px;
}
</style>
</head>

<body>
<form id="prject" class="registerform" action="demo/ajax_post.php">
            <table width="100%" style="table-layout:fixed;">
                <tr>
                    <td class="need" style="width:10px;">*</td>
                    <td style="width:70px;">�û�����</td>
                    <td style="width:205px;"><input type="text" value="" name="name" class="inputxt" ajaxurl="demo/valid.php" datatype="s6-18" errormsg="�û�������6���ַ�,���18���ַ���" /></td>
                    <td><div class="Validform_checktip">�û�������6���ַ�,���18���ַ�</div></td>
                </tr>
                <tr>
                    <td class="need">*</td>
                    <td>���룺</td>
                    <td><input type="password" value="" name="userpassword" class="inputxt" datatype="*6-16" nullmsg="���������룡" errormsg="���뷶Χ��6~16λ֮�䣡" /></td>
                    <td><div class="Validform_checktip">���뷶Χ��6~16λ֮��</div></td>
                </tr>
                <tr>
                    <td class="need">*</td>
                    <td>ȷ�����룺</td>
                    <td><input type="password" value="" name="userpassword2" class="inputxt" datatype="*" recheck="userpassword" nullmsg="��������һ�����룡" errormsg="������������˺����벻һ�£�" /></td>
                    <td><div class="Validform_checktip">��������������һ��</div></td>
                </tr>
                <tr>
                    <td class="need"></td>
                    <td></td>
                    <td colspan="2" style="padding:10px 0 18px 0;">
                        <input type="submit" value="�� ��" /> <input type="reset" value="�� ��" />
                    </td>
                </tr>
            </table>
        </form>

<script type="text/javascript">
$(document).ready(function(){   
$("#prject").Validform({
		tiptype:2
	});
});
</script>
</body></html>  