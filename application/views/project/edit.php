<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<div id="main_head" class="main_head" style="height:35px;">
<table class="menu">
<tr><td>
<a href="javascript:void(0);" class="current">������Ŀ</a>
</td></tr>
</table>
</div>
<form name="formview" id="formview" method="post" action="<?php echo site_url('project/save');?>">
<div id="main" class="main" style="padding-top:35px;">
<table cellSpacing=0 width="100%" class="content_view">
<tr><td width="100">��Ŀ����</td>
<td><input datatype="s6-18" errormsg="��Ŀ��������6���ַ�,���18���ַ���"  size="20"  name="pname" id="pname" type="text" value="<?php echo $editing['pname'];?>" ></td>
<td><div class="Validform_checktip">��Ŀ��������6���ַ�,���18���ַ�</div></td>
</tr>
<tr><td width="100">��֯����</td>
<td><select name="org_set" datatype="*" nullmsg="��ѡ��������֯������" errormsg="��ѡ��������֯������">
  <?php foreach($orgs as $value) : ?>
     <option value="<?php echo $value['GID'];  ?>" <?php  if($value['GID']==$editing['orgid']) echo 'selected=selected'?>  ><?php echo $value['ORGNAME'];  ?></option>
  <?php endforeach; ?>
  </select>
</td>
<td><div class="Validform_checktip"></div></td>
</tr>
<tr><td width="100">�ƻ���ʼʱ��</td>
<td><input datatype="*" errormsg="�ƻ���ʼʱ�䲻��Ϊ�գ�" style="width: 222px;" class="Wdate " size="20"  name="planstime" id="planstime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td>
<td><div class="Validform_checktip">ѡ��ƻ���ʼʱ��</div></td>
</tr>
<tr><td width="100">�ƻ�����ʱ��</td>
<td><input datatype="*" errormsg="�ƻ���ʼʱ�䲻��Ϊ�գ�" style="width: 222px;" class="Wdate" size="20"  name="planetime" id="planetime" type="text" value="<?php echo $editing['planEtime'];?>" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"></td>
<td><div class="Validform_checktip">ѡ��ƻ�����ʱ��</div></td>
</tr>
<tr><td width="100">��������</td>
<td><textarea style="width:668px;height:150px;" name="content" id="content"><?=isset($editing['content'])?htmlspecialchars($editing['content']):'';?></textarea></td></tr>
<tr><td></td><td>
  <!--������-->
  <input name="gid" type="hidden" id="gid" value="<?php echo $editing['uuid'];?>">
  <input name="tcontent" type="hidden" id="tcontent">
  <input name="doAction" type="hidden" id="doAction" value="<?php echo site_url('project/save')?>">  
  <input type="button" class="btn" id="save" value="����">
</td></tr>
</table>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    
});
</script>
<?php $this->load->view('foot.php');?>