<form action='' method='post'>
Name <br>
<input type='text' name='name'><br/>
Email<br>
<input type='email' name='email'><br>
Password<br>
<input type='password' name='password'><br>
<!-- add more information when user update profile-->
<input type='submit' name='signup' value='Sign Up'>
</form>
<?php
if(isset($_POST['signup'])){
    var_dump($_POST);
    $name=htmlentities(trim($_POST['name']));
    $email=htmlentities(trim($_POST['email']));
    $pass=htmlentities(trim($_POST['password']));
    $usr->Signup($name,$pass,$email);
   echo 'Please Verified Your Email';
}
?>