<?php

include_once 'dbclass/dbset.php';
$getallcat=$cat->getAllCatByViewSort();
echo '<form name="usersub" action="" method="post">';
$i=1;
echo "<table width='100%' border='1'>";
echo '<tr><td colspan="3"><div id="ltitle">User Subscribe by Category</div></td></tr>';
echo '<tr><td colspan="3"><small>* Choose category you want to get notification email when we post news</small></td></tr>';
echo "<tr>";
foreach($getallcat as $cat){
		echo "<td>";
		$id=$cat["id"];

		?>
        <input type='checkbox' name="cat[<?=$id;?>]" value="<?=$id;?>" <?=isset($_POST['cat['.$id.']'])? 'checked':'';?>/>
        
        <?php
		echo $cat['title']."_*_*_";
		echo $cat['id'];
		echo "</td>";
		if($i%3==0){
			echo "</tr><tr>";
		}
		$i++;
}
?>
</table>
<table >
<tr>
<td>Enter Email</td><td><input type="email" name="smail" required="required" value="<?=isset($_POST['smail'])? $_POST['smail']:'';?> "/></td>
<tr><td colspan="2" align="center"><input type="submit" value="SUBSCRIBE" name="detailsub" id="btn"/></td>
</tr>
</table>
</form>
<?php

	if(isset($_POST['detailsub'])){
	
	$email=htmlentities(trim($_POST['smail']));
	
	if(!isset($_POST['cat'])){
		echo "Check At least One Category ";
		exit();
	}
	else if(!$usr->email_exist($email))
	{
		echo $email."/";
		$chkmail=$usr->checkStatus($email);
		echo $chkmail['status']."/";
		
		if($chkmail['status']=='pending')
		{
			$msg= 'email is already exist, please verified or ';
			$msg.='resend verified code';//email resend
		}
		
		elseif($chkmail['status']=='block')
		{
			$msg= 'your account is already block by admin, or please Contact administartor at yeye@mail.com or <a href="contactus.php">Contact</a>';
		}
		elseif($chkmail['status']=='unscribe')
		{
			$msg= 'change status to pending, verfied again';
		}
		else
		{
		  $msg='Your Email: '.$email.' is Already Subscribe';
		}
	}
	else 
	{
		$scat=$_POST['cat'];
		//$usr->regNewDetailEmail($email,$scat);
		//$msg='Email:'.$email.' is not still verified.Please Verified your email<br/>';
	//	$msg.='or <a href="resent">resend email code</a>';
	echo 'aa';
		header ('Location : index.php?info=subscribe_success');
	}
	//echo $msg;
	}
	/*
	debug mode
	echo "<pre>";
	var_dump($_POST);
	echo "</pre>";
	echo "<pre>";
	var_dump($_POST['cat']);
	echo "</pre>";
	*/
?>