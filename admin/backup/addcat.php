
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","addcat11.php?q="+str,true);
  xmlhttp.send();
}
</script>

  <?php
			include_once 'db/catmgr.php';
			$cate=new catmgr($db);
			$topcat=$cate->gettopcat(0);
			
			
?>

	
<form action="" method="post">
	<table border="3">
		<tr>
        	<td width="220px;">Top Category</td>
			<td><select name="users" onchange="showUser(this.value)" id="txtbox">
					<option value="">--Choose Category--</option>
					<option value="aa">Add Top Category</option>
					<?php foreach($topcat as $tp){ ?>
					<option value="<?=$tp['id'];?>"><?=$tp['name'];?></option><?php } ?>
					</select>
           </td>
     </tr>
	<tr id="txtHint"></tr>
    <tr><td colspan="2" align="center"><input type="submit" name="addcat" value="AddCategory"/></td></tr>
    </table>
</form>
<div style="width:100%;clear:both;">
<?php
 if(isset($_POST['addcat']))
{
	print_r($_POST);
}
?>
</div>
</body>
</html> 