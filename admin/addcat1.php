<?php

$tcid = trim(mysql_escape_string($_POST["tcid"]));
include_once 'db/catmgr.php';
if($_POST['tcid']=='addtop'){
	echo "Add Top Category<input type='text' name='topcat'>";
	exit();
}
else
{

$cat=new catmgr($db);
			$subc=$cat->gettopcat($tcid);
?>
<label>Sub Category
<select name="second" id="drop2">
	<option value="">Please Select</option>
    <option value="addthird">Add Sub Category</option>
	<?php foreach($subc as $sub) { ?>
	<option value="<?php echo $sub["id"]; ?>"><?php echo $sub["title"]; ?></option>
	<?php } ?>
</select>
</label>
<?php 

}
?>

<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
$("select#drop2").change(function(){

	var sub3cat = $("select#drop2 option:selected").attr('value');
   //alert(sub3cat);
	if (sub3cat.length > 0 ) { 
	
	 $.ajax({
			type: "POST",
			url: "addcat11.php",
			data: "sub3cat="+sub3cat,
			cache: false,
			beforeSend: function () { 
				$('#third').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#third").html( html );
			}
		});
	} else {
		$("#third").html( "" );
	}
});

});
</script>