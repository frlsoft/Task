<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<!-- ���� -->
<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="http://127.0.0.1/x6cms/index.php?/admin/hr" method="post">
	<table class="menu">
		<tr><td><a href="http://127.0.0.1/x6cms/index.php?/admin/hr" class="current">���������</a><span></span>
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
			<!--<th width=30 align="left"><input type="checkbox" onclick="checkAll(this)"></th>-->				
				<th width="50" align="left">˳��</th>
				<th width="120" align="left">��Ŀ����</th>
				<th width="120" align="left">������</th>
				<th width="120" align="left">����</th>
				<th width="120" align="left">��ʼʱ��</th>
				<th width="120" align="left">����ʱ��</th>
				<th width="120" align="left">����ʱ��</th>
				<th width="120" align="left">����</th>
			</tr>
		</thead>
	</table>
    </div>
	<form name="formlist" id="formlist" action="#" method="post">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<tbody id="content_list">
    <?php  foreach ($projects as  $value){ ?>
	<tr id="tid_2">
        <!--<td width=30><input type=checkbox name="optid[]" value=2></td>-->
        <td width="50"><?php echo ++$i; ?></td>
    	<td width="120"><?php echo $value['pname'] ?></td>
    	<td width="120"><?php echo $value['SHOWNAME']; ?></td>
    	<td width="120"><?php echo $orgs[$value['ORGID']]['ORGNAME'] ?></td>
    	<td width="120"><?php echo $value['planstime'] ?></td>
    	<td width="120"><?php echo $value['planetime'] ?></td>
    	<td width="120"><?php echo $value['createtime'] ?></td>
    	<td width="120">
    	 <a href='<?php echo site_url('product')?>' style="text-decoration:none" alt='���' title='���'>
    	 <img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16">
    	 </a>&nbsp;&nbsp;
    	 <a href='<?php echo site_url('project/edit/gid/'.$value['uuid'])?>' style="text-decoration:none" alt='�༭' title='�༭'>
    	 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
    	 </a>&nbsp;&nbsp;
    	 <a href='#' id="in_recycle" style="text-decoration:none"  title='�������վ' onclick="in_recycle('<?php echo $value['GID']?>',this)">
    	 <img src="<?php echo base_url()?>images/icon_trash.gif" border="0" width="16" height="16" alt='�������վ'>
    	 </a>
    	</td>
	</tr>
	<?php }?>
	</tbody>
	</table>
	</form>
	<div class="main_foot">
	<table><tr><td>
	<div class="func">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/add','add')" value="���">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" value="����">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del','del')" value="ɾ��">
	
	</td><td align="right">
	<div class="page">��ҳ:��һҳ|��һҳ|��һҳ|���ҳ
	</td></tr></table>
	
<?php $this->load->view('foot.php');?>