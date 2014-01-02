<?php $this->load->view('header.php');?>
<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="http://127.0.0.1/x6cms/index.php?/admin/hr" method="post">
	<table class="menu">
		<tr><td><a href="http://127.0.0.1/x6cms/index.php?/admin/hr" class="current">待审核任务</a><span></span>
			<input type="text" name="keyword" value="" class="input-text">
			<select name="searchtype">
				<option value="title" >标题</option>
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
			<input type="submit" class="btn" value="搜索">
		</td></tr>
	</table>
	</form>
	<table cellSpacing=0 width="100%" class="content_list">
		<thead>
			<tr>
			<!--<th width=30  align="left"><input type="checkbox" onclick="checkAll(this)"></th>-->				
				<th width=50  align="left">顺序</th>
				<th align=left>任务标题</th>
				<th width=80  align=left></th>
				<th width=80   align="left">XXXX</th>
				<th width=80   align="left">XXXX</th>
				<th width=50 align="left">状态</th>
				<th width=50  align="left">操作</th>
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
			<td width=50 >进行中</td>
			<td width=80><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/edit/2','edit')" title='编辑' class='edit'></a><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" title='排序' class='order'></a><a href="javascript:submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del/2','sdel','2')" title='删除本项' class='sdel'></a></td>
	</tr>
	<?php }?>
	</tbody>
	</table>
	</div>
	</form>
	<div class="main_foot">
	<table><tr><td>
	<div class="func">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/add','add')" value="添加">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" value="排序">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del','del')" value="删除">
	</div>
	</td><td align="right">
	<div class="page">分页:第一页|上一页|下一页|最后页</div>
	</td></tr></table>
	</div>
<?php $this->load->view('foot.php');?>