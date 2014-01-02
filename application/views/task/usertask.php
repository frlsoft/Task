<?php $this->load->view('header.php');?>
<div id="loading">Loading... ...</div>
<!-- 内容 -->
<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="javascript:void(0);" method="post">
	<table class="menu">
		<tr><td><a href="javascript:void(0);" class="current">待审核任务</a><span></span>
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
				<th width="50" align="left">顺序</th>
				<th width="120" align="left">日期</th>
				<th width="120" align="left">任务名称</th>
				<th width="120" align="left">所属项目</th>
				<th width="120" align="left">开始</th>
				<th width="120" align="left">结束</th>
				<th width="120" align="right">剩余小时</th>
				<th width="120" align="left">执行</th>
				<th width="120" align="left">操作</th>
				<th width="120" align="left">人员</th>
				<th width="120" align="left">状态</th>
		 		<th width="120" align="left">编辑</th>
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
	 	<td width="120" align="right"><a href="#" title="结束任务将本任务提交给项目经理进行审核,系统进行数据校验如有未完成项目系统设为自动提交模式,请提交前检查任务是否已经完成！"><span id="closetask" uuid="<?php echo$assgin[$value['refer']]['uuid']?>">结束</span></a></td>
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
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/add','add')" value="添加">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/order','order')" value="排序">
		<input type="button" class="btn" onclick="submitTo('http://127.0.0.1/x6cms/index.php?/admin/hr/del','del')" value="删除">
	</div>
	</td><td align="right">
	<div class="page">分页:第一页|上一页|下一页|最后页</div>
	</td></tr></table></div>
<?php $this->load->view('foot.php');?>