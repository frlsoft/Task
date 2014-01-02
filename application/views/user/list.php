<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<!-- 内容 -->
<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="javascript:void(0);" method="post">
	<table class="menu">
		<tr><td><a href="javascript:void(0);" class="current">用户列表</a><span></span>
			<input type="text" name="keyword" value="" class="input-text">
			<select name="searchtype">
				<option value="NAME">用户名</option>
				<option value="SHOWNAME">显示名</option>
				<option value="yhbh">工号</option>
				<option value="ORGNAME">部门</option>
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
				<th width="50" align="left">序号</th>
				<th width="120" align="left">用户名</th>
				<th width="120" align="left">显示名</th>
				<th width="120" align="left">工号</th>
				<th width="120" align="left">部门</th>
				<th width="120" align="left">操作</th>
			</tr>
		</thead>
	</table>
    </div>
	<form name="formlist" id="formlist" action="#" method="post">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<tbody id="content_list">
    <?php  foreach ($users as  $value){ ?>
	<tr id="tid_2">
        <!--<td width=30><input type=checkbox name="optid[]" value=2></td>-->
        <td width="50"><?php echo ++$i; ?></td>
    	<td width="120"><?php echo $value['NAME'] ?></td>
    	<td width="120"><?php echo $value['SHOWNAME']; ?></td>
    	<td width="120"><?php echo $value['yhbh'] ?></td>
    	<td width="120"><?php echo $orgs[$value['ORGID']]['ORGNAME'] ?></td>
    	<td width="120">
    	 <a href='<?php echo site_url('product')?>' style="text-decoration:none" alt='浏览' title='浏览'>
    	 <img src="<?php echo base_url()?>images/icon_view.gif" border="0" width="16" height="16">
    	 </a>&nbsp;&nbsp;
    	 <a href='<?php echo site_url('user/edit/gid/'.$value['GID'])?>' style="text-decoration:none" alt='编辑' title='编辑'>
    	 <img src="<?php echo base_url()?>images/icon_edit.gif" border="0" width="16" height="16">
    	 </a>&nbsp;&nbsp;
    	 <a href='#' id="in_recycle" style="text-decoration:none"  title='放入回收站' onclick="in_recycle('<?php echo $value['GID']?>',this)">
    	 <img src="<?php echo base_url()?>images/icon_trash.gif" border="0" width="16" height="16" alt='放入回收站'>
    	 </a>
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
	</td></tr></table></div>
	
<?php $this->load->view('foot.php');?>