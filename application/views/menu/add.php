<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ޱ����ĵ�</title>
</head>

<body>
<?php echo validation_errors();?>
<?php echo form_open('menu/addMenu');?>
�˵����ƣ�<input type="input" name="name" value="<?php echo set_value('name')?>"/>
URL��ַ��<input type="input" name="url" value="<?php echo set_value('url')?>"/>
����������<input type="input" name="content" value="<?php echo set_value('content')?>"/>
�Ƿ�Ҷ�Ӳ˵�:<input name="isroot" type="checkbox" id="isroot" value="1" title="��Ҷ�Ӳ˵�url��ַ��Ч">
<input type="hidden" name="mid" value="<?php echo $mid?>"/>
<input type="submit" name="submit" value="create" />
</form>
</body>
</html>
