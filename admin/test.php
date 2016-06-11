<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include_once 'db/adsmgr.php';
$ads=new adsmgr($db);
if(isset($_POST['submit'])){
	$image="ads/".$_POST['img'];
	$caption=$_POST['cap'];
$add=$ads->addadsimg($caption,$image);
echo  $add;
}
?>

<form action="" method="post">
caption<input type="text" name="cap" /><br />
image <input type="file" name="img"/><br />
<input type="submit" name="submit" />
</form>


</body>
</html>