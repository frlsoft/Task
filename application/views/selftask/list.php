<?php
echo validation_errors();
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="<?php echo base_url()?>js/table/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/tablecloth.css" rel="stylesheet">
<link href="<?php echo base_url()?>js/table/css/prettify.css" rel="stylesheet"> 
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/table/js/jquery-1.7.2.min.js"></script>
<script language="javascript">var base_url = <?php echo '"'.base_url().'";'?></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
<script language="javascript" type="text/javascript">
function in_recycle(id,obj)
{//jquery-1.7.2.min.js
	if (confirm('ȷ���Ѹ���Ʒ�������վ��')){
    /**/
	$.ajax({
	  url: '<?php echo site_url('user/in_recycle/gid')?>'+'/'+id,
	  type: 'GET',
	 // dataType: 'html',
	  success: function(data){
		//$alertdiv.show();
	    $(obj).parents('tr:first').remove();
		data = data.replace(/[\r\n]/g,"")//ȥ���س����� ��ֹjson���ݳ����쳣		
		var json = jQuery.parseJSON(data);//��JSON�ַ���ת��ΪJSON����
		alert(json.message.flag);
		if(json.message.flag == "1"){
			$alertdiv.html("������Ϣ:�ɹ�");
		}else{
			$alertdiv.html("������Ϣ:" + json.message.info);
		}
		//_reset_page();
      }
	});
	//window.location.href= '<?php echo site_url('product/in_recycle/id')?>'+'/'+id;
    }
}
</script>
<style type="text/css">
#loading{
	z-index:10000000;
	padding:5px 0 5px 29px;
	background:url(../selftasl/images/blue-loading.gif) no-repeat 10px top;
	left:50%;
	top:50%;
	width:90px;
	position:fixed; 
	height:21px;
}
</style>
<title>�ޱ����ĵ�</title>
</head>

<body>
<div id="loading">Loading... ...</div>
<div class="container">
  <div class="row">
	<div class="span12" style="padding:20px 0;">        
	  <table cellspacing="1" cellpadding="3" class="tablehead" style="background:#CCC;">
	  <caption>
		<h3>�����������</h3>���������˵�����������
	  </caption>
	  <thead>  
		<tr class="stathead">
		  <th class="{sorter: false}" colspan="3">������Ϣ</th>
		  <th class="{sorter: false}" colspan="4">�ƻ�ʱ��</th>
		  <th class="{sorter: false}" colspan="4">ʵ��ʱ��</th>
		  <th class="{sorter: false}" colspan="6">����</th>
		</tr>
		<tr class="colhead">
		  <th class="{sorter: false}">����</th>
		  <th class="{sorter: false}">��������</th>
		  <th class="{sorter: false}">������Ŀ&nbsp;&nbsp;</th>
		  <th title="Completions" align="right">��ʼ</th>
		  <th title="Pass attempts" align="right"><span style="color:#FF0000;">����</span></th>
		  <th title="Passing yards" align="right">��ǰ</th>
		  <th title="Completion percentage" align="right">�ͺ�</th>
		  <th title="Longest pass play" align="right">��ʼ</th>
		  <th title="Passing touchdowns" align="right">����</th>
		  <th title="Interceptions thrown" align="right">��ǰ</th>
		  <th title="Passer (QB) Rating" align="right">�ͺ�</th>
		  <th title="Rushing attempts" align="right">Ԥ��</th>
		  <th title="Total rushing yards" align="right">�༭</th>
		  <th title="Average yards per carry" align="right">ִ��</th>
		  <th title="Longest run" align="right">��Ա</th>
		  <th title="Rushing touchdowns" align="right">״̬</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php  foreach ($tasks as  $value){ ?>
	  <tr class="oddrow">
	  <td><?php echo date_format(date_create($value['ctime']), 'Y-m-d'); ?></td>
	  <td><?php echo $value['caption'] ?></td>
	  <td><span class="greenfont"><?php echo $orgs[$value['projectuuid']]['pname'] ?></span></td>
	  <td align="right"><?php echo date_format(date_create($value['planStime']), 'Y-m-d'); ?></td>
	  <td align="right"><?php echo date_format(date_create($value['planEtime']), 'Y-m-d'); ?></td>
	  <td align="right">11</td>
	  <td align="right">11</td>
	  <td align="right"><?php echo date_format(date_create($value['starttime']), 'Y-m-d'); ?></td>
	  <td align="right"><?php echo date_format(date_create($value['finishtime']), 'Y-m-d'); ?></td>
	  <td align="right">0</td>
	  <td align="right">123</td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16"></td>
	  <td align="right"><a href="<?php echo site_url('selftask/edit/gid/'.$value['uuid'])?>">����</a></td>
	  <td align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	  <td align="right"><?php echo $status[$value['status']] ?></td>
	  </tr>
	  <?php  } ?>
	  </tbody>
	  <thead>
		<tr class="colhead {sorter: false}">
		  <th colspan="16">ͳ��</th>
		</tr>
	  </thead>
	  <tbody>
	  <tr class="evenrow"><td>1/3</td><td>&nbsp;</td>
	  <td><span class="redfont">L</span></td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  </tr>
	  </tbody></table>
	  </div>
  </div>
</div>

<script src="<?php echo base_url()?>js/table/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.metadata.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url()?>js/table/js/jquery.tablecloth.js"></script>
</div>
<script type="text/javascript">
$("#loading").fadeOut();
  $(document).ready(function() {
	$("table").tablecloth({
	  theme: "paper",
	  striped: true,
	  sortable: true,
	  condensed: true
	});
  });
</script>
</body>
</html>