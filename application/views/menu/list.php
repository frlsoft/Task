<?php
$CI = get_instance ();
$CI->load->helper ( 'url' );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/MzTreeView10.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<title>�˵�����</title>
</head>

<body>
<form name="form1" method="post" action=""></form>
<style>
A.MzTreeview {
	font-size: 9pt;
	padding-left: 3px;
}
</style>
<script language="JavaScript">
  var uuid = "";
  var tree = new MzTreeView("tree");

  tree.icons["property"] = "property.gif";
  tree.icons["css"] = "collection.gif";
  tree.icons["book.gif"]  = "book.gif";
  tree.iconsExpand["book.gif"] = "bookopen.gif"; //չ��ʱ��Ӧ��ͼƬ

  tree.setIconPath("<?php echo base_url()?>images/"); //�������·��

  <?php
		foreach ( $result as $row ) {
			// echo "<input type=\"checkbox\" name=\"checkbox\" value=\"".$row ['NAME']."\">".$row ['NAME'].'<br>';data:'.$row['M_MID'].'
			echo 'tree.nodes["' . $row ['P_MID'] . '_' . $row ['M_MID'] . '"] = "' . 'text:' . $row ['NAME'] . ';method:show(' . $row ['M_MID'] . ');target:menu;icon:book.gif' . '";';
			// 'title:'.$row['NAME'].';';
		}
		?> 
  //tree.setURL("addMenu");
  tree.setTarget("MzMain");
  document.write(tree.toString());    //����� obj.innerHTML = tree.toString();

  function show(par){
 	  uuid = par;
	  var url = "<?php echo base_url()?>" + "index.php/menu/addmenu/"+par;
	  //var url = "<?php echo base_url()?>" + "index.php/menu/getMenu/"+par;
	  //alert(url);
	  window.location.href = url;
  }

function expandAll(){tree.expandAll();}
$(document).ready(function(){
	$("a").click(function(){		
		if(uuid==""){
			alert("��ѡ��ڵ��ڲ���");
		}else{
			$("#add").click(function(){				
				alert($(this));
			});
			$("#del").click(function(){					
					alert($(this));
			});
			$("#edit").click(function(){					
					alert($(this));
			});	
		}
	});
	
});
</script>
<div id="add">��Ӳ˵�</div>|<div id="del">ɾ���˵�</div>|<div id="edit">�༭�˵�</div>
</body>
</html>
