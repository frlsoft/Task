<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�ޱ����ĵ�</title>
</head>

<body>
<?php echo validation_errors();?>
<?php echo form_open('role/addRole');?>
<input type="input" name="name" value="<?php echo set_value('name')?>"/>
<input type="submit" name="submit" value="create" />
</form>
</body>
</html>
