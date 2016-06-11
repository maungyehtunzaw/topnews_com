<?php
include_once 'db/catmgr.php';
			$cat=new catmgr($db);
			//$alltopcat=$cat->gettopcat(0);
			if(isset($_POST['tid'])){
		
			$tid=$_POST['tid'];
			echo $tid;
			if($tid=='addtop'){
			?>
			Add new Top Category <input type='text' name='addtop'>
			<?php
			}
			else{
			$subcat=$cat->gettopcat($tid);
			?>
			<select name='seccat' id='dropdown2'>
			<option value='addsecond'>Add Second Cat</option>
			<?php
			foreach($subcat as $sc){
			?>
			<option value="<?=$sc['id'];?>"><?=$sc['title'];?></option>
			
			<?php
			}
			?>
			</select>
			<?php
			}
			}
			
			if(isset($_POST['sid'])){
			$sid=$_POST['sid'];
			echo 'sid'.$sid;
			
			
			if($sid=='addsecond'){
					?>
					Add second Sub-Category <input type='text' name='seccat'>
					<?php
				}
				else{
				$tcat=$cat->gettopcat($sid);
				?>
				<select name='thrcat' id='dropdown2'>
				<option value='addtrd'>Add Third Category</option>
				<?php
			foreach($tcat as $tc){
			?>
			<option value="<?=$tc['id'];?>"><?=$tc['title'];?></option>
			
			<?php
			}
			?>
			</select>
			<?php
				}
			}
			
			echo 'reach';
			?>
			
			