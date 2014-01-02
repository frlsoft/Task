<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<div id="main_head" class="main_head" style="height:35px;">
<table class="menu">
<tr><td>
<a href="javascript:void(0);" class="current">用户管理</a><a href="javascript:void(0);" class="current">用户列表</a>
</td></tr>
</table>
</div>
<form name="formview" id="formview" method="post" action="<?php echo site_url('user/save');?>">
<div id="main" class="main" style="padding-top:35px;">
<table cellSpacing=0 width="100%" class="content_view">
	<tr><td width="100">登陆名</td>
	<td><input datatype="s4-20" errormsg="项目名称至少6个字符,最多18个字符！" size="20"  name="name" id="name" type="text" value="<?php echo $editing['NAME'];?>"></td>
	<td><div class="Validform_checktip">登陆名至少4个字符,最多20个字符</div></td>
	</tr>

	<tr><td width="100">所属组织机构</td>
	<td><select name="org_set" datatype="*" nullmsg="请选择所属组织机构！" errormsg="请选择所属组织机构！">
		<?php foreach($orgs as $value) :  ?>
			<option value='<?php echo $value['GID'];  ?>' <?php  if($value['GID']==$editing['ORGID']) echo 'selected=selected'?>><?php echo $value['ORGNAME'];  ?></option>
		<?php endforeach; ?>
		</select>
	</td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">显示名</td>
	<td><input datatype="s2-5" errormsg="显示名为2-5个汉字" style="width: 222px;" size="20"  name="showname" id="showname" type="text" value="<?php echo $editing['SHOWNAME'];?>" ></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">登陆密码</td>
	<td><input datatype="*" errormsg="密码不能为空" style="width: 222px;" class="x-form-text x-form-field " size="20"  name="password" id="password" type="password" ></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">工号</td>
	<td><input datatype="s6-6" errormsg="工号为6位编码" style="width: 222px;"  size="20"  name="yhbh" id="yhbh" type="text" value="<?php echo $editing['yhbh'];?>"></td>
	<td><div class="Validform_checktip"></div></td>
	</tr>

	<tr><td width="100">内容描述</td>
	<td><textarea style="width:668px;height:150px;" name="content" id="content"><?=isset($editing['content'])?htmlspecialchars($editing['content']):'';?></textarea></td>
	</tr>

	<tr>
	<td></td>
	<td>
	  <!--工具栏-->
	  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['GID'];?>">
	  <input name="tcontent" type="hidden" id="tcontent">
	  <input type="button" class="btn" id="save" value="保存">
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