<?php
$general->logged_in_protect();

if (empty($_POST) === false) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Sorry, but we need your username and password.';
	} else if ($usr->user_exists($username) === false) {
		$errors[] = 'Sorry that username doesn\'t exists.';
	} /*else if ($usr->email_confirmed($username) === false) {
		$errors[] = 'Sorry, but you need to activate your account. 
					 Please check your email.';
	}*/ else {
		if (strlen($password) > 18) {
			$errors[] = 'The password should be less than 18 characters, without spacing.';
		}
		$login = $usr->Signin($username, $password);
		if ($login === false) {
			$errors[] = 'Sorry, that username/password is invalid';
		}else {
			session_regenerate_id(true);// destroying the old session id and creating a new one
			$_SESSION['id'] =  $login;
                        session_start();
                        if(isset($_SESSION['id']))
                        {
                            echo 'shit';
                        }
			//header('Location: index.php');
			exit();
		}
	}
}
?>
<form action='' method='post'>
username or email<br/>
<input type='text' name='username'><br>
password<br />
<input type='password' name='password'><br/>
<input type='checkbox' name='remember'> Remember Me A Week?<br>
<a href='forgotpassword.php'>if you forgot password, click me!</a><br>
<input type='submit' name='signin' value='sign in'>
</form>