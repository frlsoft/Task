<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>无标题文档</title>
</head>

<body>
<?php echo validation_errors();?>
<?php echo form_open('menu/addMenu');?>
菜单名称：<input type="input" name="name" value="<?php echo set_value('name')?>"/>
URL地址：<input type="input" name="url" value="<?php echo set_value('url')?>"/>
功能描述：<input type="input" name="content" value="<?php echo set_value('content')?>"/>
是否叶子菜单:<input name="isroot" type="checkbox" id="isroot" value="1" title="非叶子菜单url地址无效">
<input type="hidden" name="mid" value="<?php echo $mid?>"/>
<input type="submit" name="submit" value="create" />
</form>
</body>
</html>
