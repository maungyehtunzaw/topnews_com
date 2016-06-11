<?php
include_once 'dbclass/dbset.php';
include_once 'dbclass/user.php';
$user=new User($db);
if(isset($_GET['link']) && isset($_GET['id']) && isset($_GET['code'])){
	$id=trim(htmlentities($_GET['id']));
	$code=trim(htmlentities($_GET['code']));
	$checkusr=$user->checkMailCode($id,$code);
	var_dump($checkusr);
	if($checkusr)
	{
		echo 'do activate';
		echo $id;
		$user->activateEmail($id);
	}
}
elseif(isset($_GET['pin'])){
	$pin=trim($_GET['pin']);
	?>
    <form>
    <input type="number" size="4"  maxlength="4"  autocomplete="off" required>
    <input type="submit">
    </form>
    <?php
}
?>