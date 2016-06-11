<?php
if(!$_GET['info']){
header ('Location : index.php');
}
$info=$_GET['info'];
echo $info;
if($info=='subscribe_success'){
?>
<div class='successinfo'>Your Email Subscribe is Successful, Please Activate in your Email or <a href='resent'>Resend Email Activation Link</a>
<?php
}
?>