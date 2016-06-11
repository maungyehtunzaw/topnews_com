<?php
include_once 'db/adsmgr.php';
include_once 'db/general.php';
$ads=new adsmgr($db);

?>

<form action="" method="post" enctype="multipart/form-data">
<table class="formaction" border="1">
<caption align="center"><h3><?php echo strtoupper($_GET['action']); ?> ADS</h3></caption>

	<tr>
		<td width="200px;">
			Ads Name
		</td>
		<td>
			<input type="text" name="name" placeholder="enter ads name" value="<?php if(isset($view)){echo $view==true? $name:'';} else {echo '';}?>" id="txtbox">
		</td>
	</tr>
    
    <tr>
    	<td>
        	Description
        </td>
        <td>
			<textarea name="description" id="txtaea"><?php if(isset($view)){echo $view==true? $description :'';} else {echo '';}?></textarea>
		</td>
    </tr>
	
    <tr>
    	<td>
			Ads Link
		</td>
        <td>
			<input type="url" name="link" value="<?php if(isset($view)){echo $view==true? $link:'';} else {echo '';}?>" id="txtbox">
		</td>
	</tr>
	
    <tr>
    	<td>
			Price
		</td>
        <td>
			<input type="text" name="price" value="<?php if(isset($view)){echo $view==true? $pirce:'';} else {echo '';}?>" id="txtbox">
		</td>
    </tr>
	
    <tr>
    	<td>
			Status
		</td>
        <td>
        	<select name="status" id="sele">
            	<option value="null" >--Choose--</option>            
            	<option value="enable" title="show ads">Enable</option>
        		<option value="disable" title="hide ads">Disable</option>
            </select>
        </td>
    </tr>
	
    <tr>
    	<td>
			TYPE
		</td>
        <td>
        	<select name="type" id="sele">
            	<option value="null" >--Choose--</option>
            	<option value="level1" title="show ads">Banner</option>
        		<option value="level2" title="hide ads">Home</option>
        		<option value="level2" title="hide ads">Article</option>                
            </select>
        </td>
    </tr>
	
	<tr>
    	<td>
			Keyword
		</td>
        <td>
        	<input type="text" id="txtbox" name="ky" />
        </td>
    </tr>
	
    <tr>
    	<td>
			Expriation Date
		</td>
        <td>
			<input type="date" name="expdate" id="txtbox">
		</td>
    </tr>
	
    <tr>
    	<td>
			Ads Image
		</td>
        <td>        
			<input type="file" name="image" required="required">
		</td>
    </tr>
	
    <tr>
    	<td>
        	Image Caption
        </td>
    	<td>
        	<input type="text" name="caption" id="txtbox" />
        </td>
    </tr>
        
    <?php if(isset($_GET['action'])){
		  if($_GET['action']=='view'){
			  ?>
    <tr>
         <td>
			View Count
		</td>
        <td>
			<input type="text" name="viewcount" disabled="disabled" value="<?php if(isset($view)){echo $view==true? $ads_view_count:'';} else {echo '';}?>"/>
		</td>
     </tr>
	 
     <tr>
     	<td>
			Click Count
		</td>
        <td>
			<input type="text" name="clickcount" disabled="disabled" value="<?php if(isset($view)){echo $view==true? $ads_click_count:'';} else {echo '';}?>"/>
		</td>
     </tr>
	 
     <tr>
     	<td>
			Status
		</td>
        <td>
			<input type="text" name="status" value="<?php if(isset($view)){echo $view==true? $ads_status:'';} else {echo '';}?>"/>
	</td>	
    </tr>
	 
    <tr>
     	<td>
			Creation Date
		</td>
        <td>
			<input type="text" name="cdate" value="<?php if(isset($view)){echo $view==true? $ads_c_date:'';} else {echo '';}?>"/>
		</td>
    </tr>
	   
    <tr>
     	<td colspan="2" align="center">
			<a href="index.php?page=addnewads&action=edit&id=<?=$_GET['id'];?>" class="btn">edit</a>
			<a href="index.php?page=adsmanager" class="btn">back</a>
        </td>
    </tr>
	
</table>
        	         
	<?php	}
	elseif($_GET['action']=='add'){?>
    <tr>
		<td colspan="2" align="center">
			<input type="submit" value="save" name="submit" class="btn"> 
    		<input type="reset" value="clear" name="clear" class="btn">
            <input type="submit" value="cancel" name="cancel" class="btn">
		</td>
   </tr>
   
</table>

<?php } 
elseif($_GET['action']=='edit'){
	?>
    <tr>
		<td colspan="2" align="center">
			<input type="submit" value="update" name="submit" class="btn"> 
			<input type="submit" value="cancel" name="cancel" class="btn">
		</td>
   </tr>
</table

	><?php
	}

}?>
</form>   
