<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<div id="main_head" class="main_head" style="height:35px;">
<table class="menu">
<tr><td>
<a href="javascript:void(0);" class="current">创建项目</a>
</td></tr>
</table>
</div>
<form name="formview" id="formview" method="post" action="<?php echo site_url('project/save');?>">
<div id="main" class="main" style="padding-top:35px;">
<table cellSpacing=0 width="100%" class="content_view">
<tr><td width="100">项目名称</td>
<td><input datatype="s6-18" errormsg="项目名称至少6个字符,最多18个字符！"  size="20"  name="pname" id="pname" type="text" value="<?php echo $editing['pname'];?>" ></td>
<td><div class="Validform_checktip">项目名称至少6个字符,最多18个字符</div></td>
</tr>
<tr><td width="100">组织机构</td>
<td><select name="org_set" datatype="*" nullmsg="请选择所属组织机构！" errormsg="请选择所属组织机构！">
  <?php foreach($orgs as $value) : ?>
     <option value="<?php echo $value['GID'];  ?>" <?php  if($value['GID']==$editing['orgid']) echo 'selected=selected'?>  ><?php echo $value['ORGNAME'];  ?></option>
  <?php endforeach; ?>
  </select>
</td>
<td><div class="Validform_checktip"></div></td>
</tr>
<tr><td width="100">计划开始时间</td>
<td><input datatype="*" errormsg="计划开始时间不能为空！" style="width: 222px;" class="Wdate " size="20"  name="planstime" id="planstime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td>
<td><div class="Validform_checktip">选择计划开始时间</div></td>
</tr>
<tr><td width="100">计划结束时间</td>
<td><input datatype="*" errormsg="计划开始时间不能为空！" style="width: 222px;" class="Wdate" size="20"  name="planetime" id="planetime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td>
<td><div class="Validform_checktip">选择计划结束时间</div></td>
</tr>
<tr><td width="100">内容描述</td>
<td><textarea style="width:668px;height:150px;" name="content" id="content"><?=isset($editing['content'])?htmlspecialchars($editing['content']):'';?></textarea></td></tr>
<tr><td></td><td>
  <!--工具栏-->
  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['uuid'];?>">
  <input name="tcontent" type="hidden" id="tcontent">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('project/save')?>">  
  <input type="button" class="btn" id="save" value="保存">
</td></tr>
</table>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    
});
</script>
<?php $this->load->view('foot.php');?>