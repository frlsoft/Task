<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<!-- ���� -->
<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="javascript:void(0);" method="post">
	<table class="menu">
		<tr><td><a href="javascript:void(0);" class="current">���������</a><span></span>
			<input type="text" name="keyword" value="" class="input-text">
			<select name="searchtype">
				<option value="title" >����</option>
				<option value="id" >ID</option>
			</select>
			<select name="category">
				<option value="0">XXXX</option>
				<option value="5">XXXX</option>
				<option value="6">XXXX</option>
			</select>
			<select name="recommend">
				<option value="0">XXXX</option>
				</select>
			<input type="submit" class="btn" value="����">
		</td></tr>
	</table>
	</form>
	<table cellSpacing=0 width="100%" class="content_list">
		<thead>
			<tr>
				<th width="50" align="left">˳��</th>
				<th width="120" align="left">����</th>
				<th width="120" align="left">��������</th>
				<th width="120" align="left">������Ŀ</th>
				<th width="120" align="left">��ʼ</th>
				<th width="120" align="left">����</th>
				<th width="120" align="right">ʣ��Сʱ</th>
				<th width="120" align="left">ִ��</th>
				<th width="120" align="left">����</th>
				<th width="120" align="left">��Ա</th>
				<th width="120" align="left">״̬</th>
		 		<th width="120" align="left">�༭</th>
			</tr>
		</thead>
	</table>
    </div>
	<form name="formlist" id="formlist" action="#" method="post">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<tbody id="content_list">
    <?php  foreach ($tasks as  $value){ ?>
	<tr id="tid_2">
        <!--<td width=30><input type=checkbox name="optid[]" value=2></td>-->
        <td width="50"><?php echo ++$i; ?></td>
    	<td width="120"><?php echo date_format(date_create($value['ctime']), 'Y-m-d'); ?></td>
	 	<td width="120"><?php echo $value['caption'] ?></td>
	 	<td width="120"><span class="greenfont"><?php echo $orgs[$value['projectuuid']]['pname'] ?></span></td>
	  	<td width="120" align="right"><?php echo date_format(date_create($value['planStime']), 'Y-m-d'); ?></td>
	  	<td width="120" align="right"><?php if(!$value['planEtime']);echo date_format(date_create($value['planEtime']), 'Y-m-d'); ?></td>
	 	<td width="120" align="right">&nbsp;</td>
	  	<td width="120" align="right"><img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16"></td>
	 	<td width="120" align="right"><a href="#" title="�������񽫱������ύ����Ŀ����������,ϵͳ��������У������δ�����Ŀϵͳ��Ϊ�Զ��ύģʽ,���ύǰ��������Ƿ��Ѿ���ɣ�"><span id="closetask" uuid="<?php echo$assgin[$value['refer']]['uuid']?>">����</span></a></td>
	  	<td width="120" align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	  	<td width="120" align="right"><a href="<?php echo site_url('task/usertaskop/uuid/'.$assgin[$value['refer']]['uuid'])?>"><?php echo $readed[$assgin[$value['refer']]['readed']] ?></a></td>
	  	<td width="120" align="right"><img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16"></td>
	</tr>
	<?php }?>
	</tbody>
	</table>
</div>
	</form>

	<div class="main_foot">
	<table><tr><td>
	<div class="func">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/add','add')" value="���">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" value="����">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del','del')" value="ɾ��">
	</div>
	</td><td align="right">
	<div class="page">��ҳ:��һҳ|��һҳ|��һҳ|���ҳ</div>
	</td></tr></table></div>
<?php $this->load->view('foot.php');?>