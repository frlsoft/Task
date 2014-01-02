<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<div id="main_head" class="main_head" style="height:35px;">
<table class="menu">
<tr><td>
<a href="javascript:void(0);" class="current">创建任务</a>
</td></tr>
</table>
</div>
<form name="formview" id="formview" method="post" action="<?php echo site_url('task/save');?>">
<div id="main" class="main" style="padding-top:35px;">
<table cellSpacing=0 width="100%" class="content_view">
<tr><td width="100">任务名称</td>
<td><input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="caption" id="caption" type="text" value="<?php echo $editing['caption'];?>" ></td></tr>
<tr><td width="100">所属项目</td>
<td><select name="projectuuid">
  <?php foreach($projects as $value) :  ?>
	   <option value='<?php echo $value['uuid'];  ?>' <?php  if($value['GID']==$editing['projectuuid']) echo 'selected=selected'?>  ><?php echo $value['pname'];  ?></option>
  <?php endforeach; ?>
  </select></td></tr>
<tr><td width="100">计划开始时间</td>
<td><input style="width: 222px;" class="Wdate " size="20"  name="planStime" id="planStime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td></tr>
<tr><td width="100">计划结束时间</td>
<td><input style="width: 222px;" class="Wdate" size="20"  name="planEtime" id="planEtime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td></tr>
<tr><td width="100">任务说明</td><td><input style="width: 222px;" class="x-form-text x-form-field " size="20"  name="content" id="content" type="text" value="<?php echo $editing['content'];?>" ></td></tr>
<tr><td width="100">任务执行人</td><td><input name="btnuser" type="button" id="btnuser" value="选择任务接收人" ></td></tr>
<tr><td></td><td>
  <input type="button" class="btn" id="save" value="保存">
  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['uuid'];?>">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('task/save')?>">
  <input name="userlist" type="hidden" id="userlist" value=""><!--用户任务分配表ID-->
  <input name="root" type="hidden" id="root" value="<?php echo $editing['root']?$editing['root']:'11';?>"><!--节点ID形成统计关系-->
  <input name="addNew" type="hidden" id="addNew" value="1"><!---->
  <input name="refer" type="hidden" id="refer" value="<?php echo $editing['refer']?$editing['refer']:'00';?>"><!--关联ID-->
  <input type="submit" class="btn" name="Submit" value="提交">
</td></tr>
</table>
</div>
</form>

<?php $this->load->view('foot.php');?>	