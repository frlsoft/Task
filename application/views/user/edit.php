<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<div id="main_head" class="main_head" style="height:35px;">
<table class="menu">
<tr><td>
<a href="javascript:void(0);" class="current">�û�����</a><a href="javascript:void(0);" class="current">�û��б�</a>
</td></tr>
</table>
</div>
<form name="formview" id="formview" method="post" action="<?php echo site_url('user/save');?>">
<div id="main" class="main" style="padding-top:35px;">
<table cellSpacing=0 width="100%" class="content_view">
	<tr><td width="100">��½��</td>
	<td><input datatype="s4-20" errormsg="��Ŀ��������6���ַ�,���18���ַ���" size="20"  name="name" id="name" type="text" value="<?php echo $editing['NAME'];?>"></td>
	<td><div class="Validform_checktip">��½������4���ַ�,���20���ַ�</div></td>
	</tr>

	<tr><td width="100">������֯����</td>
	<td><select name="org_set" datatype="*" nullmsg="��ѡ��������֯������" errormsg="��ѡ��������֯������">
		<?php foreach($orgs as $value) :  ?>
			<option value='<?php echo $value['GID'];  ?>' <?php  if($value['GID']==$editing['ORGID']) echo 'selected=selected'?>><?php echo $value['ORGNAME'];  ?></option>
		<?php endforeach; ?>
		</select>
	</td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">��ʾ��</td>
	<td><input datatype="s2-5" errormsg="��ʾ��Ϊ2-5������" style="width: 222px;" size="20"  name="showname" id="showname" type="text" value="<?php echo $editing['SHOWNAME'];?>" ></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">��½����</td>
	<td><input datatype="*" errormsg="���벻��Ϊ��" style="width: 222px;" class="x-form-text x-form-field " size="20"  name="password" id="password" type="password" ></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">����</td>
	<td><input datatype="s6-6" errormsg="����Ϊ6λ����" style="width: 222px;"  size="20"  name="yhbh" id="yhbh" type="text" value="<?php echo $editing['yhbh'];?>"></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">��������</td>
	<td><textarea style="width:668px;height:150px;" name="content" id="content"><?=isset($editing['content'])?htmlspecialchars($editing['content']):'';?></textarea></td>
	</tr>

	<tr>
	<td></td>
	<td>
	  <!--������-->
	  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['GID'];?>">
	  <input name="tcontent" type="hidden" id="tcontent">
	  <input type="button" class="btn" id="save" value="����">
	</td>
	</tr>
</table>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    
});
</script>
<?php $this->load->view('foot.php');?>