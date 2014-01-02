<?php
$CI = get_instance();
$CI->load->helper("url");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>帮助文档</title>
<link rel="stylesheet" href="<?php echo base_url()?>js/formplugin/jqtransform.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url()?>js/formplugin/jquery.jqtransform.js" ></script>
<script language="javascript">
	$(function(){
		$('form').jqTransform({imgPath:'jqtransformplugin/img/'});
	});
</script>
</head>

<body>
帮助文档
<form action="post.php" method="POST">
	<div class="rowElem"><label>Input Text:</label><input type="text" name="inputtext"/></div>
	<div class="rowElem"><label>Input Password:</label><input type="password" /></div>
	<div class="rowElem"><label>Checkbox: </label><input type="checkbox" name="chbox" id=""></div>
	<div class="rowElem"><label>Radio :</label> 
		<input type="radio" id="" name="question" value="oui" checked ><label>oui</label>
		<input type="radio" id="" name="question" value="non" ><label>non</label></div>
	<div class="rowElem"><label>Textarea :</label> <textarea cols="40" rows="12" name="mytext"></textarea></div>

	<div class="rowElem">
		<label>Select :</label>
		<select name="select">
			<option value="">1&nbsp;</option>
			<option value="opt1">2&nbsp;</option>
		</select>
	</div>
	<div class="rowElem">
		<label>Select Redimentionn茅 :</label>
		<select name="select2" >
			<option value="opt1">Big Option test line with more wordssss</option>
			<option value="opt2">Option 2</option>
			<option value="opt3">Option 3</option>
			<option value="opt4">Option 4</option>
			<option value="opt5">Option 5</option>
			<option value="opt6">Option 6</option>
			<option value="opt7">Option 7</option>
			<option value="opt8">Option 8</option>
		</select>
	</div>
	
	<div class="rowElem"><label>Submit button:</label><input type="submit" value="Envoyer" /></div>
	<div class="rowElem"><label>Reset button:</label><input type="reset" value="Annuler" /></div>
	<div class="rowElem"><label>Input button:</label><input type="button" value="bouton" /></div>
			
</form>

</body>
</html>
