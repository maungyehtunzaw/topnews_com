<?php
 $sub3cat = trim(mysql_escape_string($_POST["sub3cat"]));
 include_once 'db/catmgr.php';
 $cat=new catmgr($db);
	$third=$cat->gettopcat($_POST['sub3cat']);
 
if($_POST['sub3cat']=='addthird'){
	echo "Add Second Category<input type='text' name='seccat'>";
	exit();
}
else if($third){	
?>
<label>Third Category: 
<select name="third" id='drop3'>
	<?php foreach($third as $td) { ?>
	<option value="<?php echo $td["id"]; ?>"><?php echo $td["title"]; ?></option>
	<?php } ?>
</select>
</label>
<br>
<?php

}
?>
Add Third Category<input type='text' name='thirdcat'>
