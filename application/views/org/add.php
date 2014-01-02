<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>无标题文档</title>
</head>

<body>
<?php echo validation_errors();?>
<?php echo form_open('org/addOrg');?>
<input type="input" name="orgname" value="<?php echo set_value('orgname')?>"/>
<input type="hidden" name="pid" value="<?php echo $pid?>"/>
<input type="submit" name="submit" value="create" />
</form>
</body>
</html>
