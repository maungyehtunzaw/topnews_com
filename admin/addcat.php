<?php
include_once 'db/catmgr.php';
			$cat=new catmgr($db);
			$alltopcat=$cat->gettopcat(0);
	
		?>
        <div style="clear:both">
        <hr />
        <?php if($_GET['action']=='addcat'){ ?>
        <form action="" method="post" name="addcat">
            <label>Top Category
            <select name="first" id = "drop1">
              <option value="">Please Select</option>
              <option value="addtop">Add Top Category</option>
              <?php  foreach($alltopcat as $tc){ ?>
              <option value="<?php echo $tc["id"]; ?>"><?php echo $tc["title"]; ?></option>
              <?php } ?>
              
            </select>
            </label>
            <?php }
			else if($_GET['action']=='edit' && isset($_GET['id'])){
				echo $id=$_GET['id'];
			$parendid=$cat->getParentID($id);
			$pid=$parendid['parent_id'];
			if($pid==0){
				
			}
			
			}
			?>
          </div>

        <div class="cascade" id="second"></div> 
		<div class="cascade" id="third" ></div> 
		<br />
            Page Title <input type="text" name='pagetitle' />
            <br />
            Keyword<textarea name="keyword"></textarea>
			<br />
			Status <select name='status'>
			<option value='enable'>Publish</option>
			<option value='disable'>Unpublish</option>
			</select>
			<br>
			<input type='submit' value='add' name='add'/>
			<input type='reset' value='cancel' />
			</form>
			   
    </div>
	<?php
	if(isset($_POST['add']))
	var_dump($_POST);
	if(isset($_POST['topcat']))
	echo 'adding top category';
	if(isset($_POST['seccat']))
	echo 'adding second cat';
	if(isset($_POST['thirdcat']))
	echo 'adding thrid cat';
	?>
  </div>
<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
$("select#drop1").change(function(){

	var tcid =  $("select#drop1 option:selected").attr('value'); 
// alert(country_id);	
	$("#state").html( "" );
	$("#city").html( "" );
	if (tcid.length > 0 ) { 
		
	 $.ajax({
			type: "POST",
			url: "addcat1.php",
			data: "tcid="+tcid,
			cache: false,
			beforeSend: function () { 
				$('#second').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {    
				$("#second").html( html );
			}
		});
	} 
});
});
</script>
</body>
</html>
