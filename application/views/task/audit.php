<?php $this->load->view('header.php');?>
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
			<!--<th width=30  align="left"><input type="checkbox" onclick="checkAll(this)"></th>-->				
				<th width=50  align="left">˳��</th>
				<th align=left>�������</th>
				<th width=80  align=left></th>
				<th width=80   align="left">XXXX</th>
				<th width=80   align="left">XXXX</th>
				<th width=50 align="left">״̬</th>
				<th width=50  align="left">����</th>
			</tr>
		</thead>
	</table>
	</div>
	<form name="formlist" id="formlist" action="http://127.0.0.1/x6cms/index.php?/admin/hr" method="post">
	<input type="hidden" name="action" id="action" value="http://127.0.0.1/x6cms/index.php?/admin/hr">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<tbody id="content_list">
	<?php foreach($tasks as $v){?>
	<tr id="tid_2">
	<!--<td width=30><input type=checkbox name="optid[]" value=2></td>-->			
			<td width=40><?php echo ++$i;?></td>
			<td><?php echo $v['caption'];?></td>
			<td width=80>&nbsp;</td>
			<td width=80>&nbsp;</td>
			<td width=50 >������</td>
			<td width=80><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/edit/2','edit')" title='�༭' class='edit'></a><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" title='����' class='order'></a><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del/2','sdel','2')" title='ɾ������' class='sdel'></a></td>
	</tr>
	<?php }?>
	</tbody>
	</table>
	</div>
	</form>
	<div class="main_foot">
	<table><tr><td>
	<div class="func">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/add','add')" value="����">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" value="����">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del','del')" value="ɾ��">
	</div>
	</td><td align="right">
	<div class="page">��ҳ:��һҳ|��һҳ|��һҳ|���ҳ</div>
	</td></tr></table>
	</div>
<?php $this->load->view('foot.php');?>