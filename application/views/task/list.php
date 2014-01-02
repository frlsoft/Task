<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<!-- 内容 -->
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
			<!--<th width=30 align="left"><input type="checkbox" onclick="checkAll(this)"></th>-->				
				<th width="50" align="left">顺序</th>
				<th align="left">任务名称</th>
				<th width="120" align="left">计划开始时间</th>
				<th width="120" align="left">计划结束时间</th>
				<th width="120" align="left">所属项目</th>
				<th width="80" align="left">任务用户</th>
				<th width="50" align="left">状态</th>
				<th width="50" align="left">操作</th>
			</tr>
		</thead>
	</table>
	</div>
	<form name="formlist" id="formlist" action="http://127.0.0.1/x6cms/index.php?/admin/hr" method="post">
	<input type="hidden" name="action" id="action" value="http://127.0.0.1/x6cms/index.php?/admin/hr">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<tbody id="content_list">
	<?php foreach($tasks as $value){?>
	<tr id="tid_2">
	<!--<td width=30><input type=checkbox name="optid[]" value=2></td>-->			
			<td width="50"><?php echo ++$i;?></td>
			<td><?php echo $value['caption'] ?></td>
			<td width="120"><?php echo $value['planStime']; ?></td>
			<td width="120"><?php echo $value['planEtime'] ?></td>
			<td width="120"><?php echo $orgs[$value['projectuuid']]['pname'] ?></td>
			<td width="80" ><a href="<?php echo $value['refer'] ?>">查看</a></td>
			<td width="50" >进行中</td>
			<td width="50">
			<a href='<?php echo site_url('task/edit/gid/'.$value['uuid'])?>' style="text-decoration:none" alt='编辑' title='编辑'><img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16"></a>
			</td>
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