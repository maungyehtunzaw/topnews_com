<?php
require 'db/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) {

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Sorry, but we need your username and password.';
	} else if ($users->user_exists($username) === false) {
		$errors[] = 'Sorry that username doesn\'t exists.';
	}
	/* else if ($users->checkuserstatus($username) === false) {
		echo 'error in check usr status';
		$errors[] = 'Sorry, but you need to activate your account. 
					 Please check your email.';
	}*/
	
	 else {
		if (strlen($password) > 5) {
			$errors[] = 'The password should be less than 18 characters, without spacing.';
		}
		
		$login = $users->login($username,$password);
		if ($login === false) {
			$errors[] = 'Sorry, that username/password is invalid';
		}else {
			session_regenerate_id(true);// destroying the old session id and creating a new one
			$_SESSION['id'] =  $login;
			header('Location: index.php');
			exit();
		}
	}
} 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styleupadmin.css" >
	<title>Admin Login page</title>
</head>
<body>	
	<div id="logg">
	
		<h3>Login</h3>
		<small>demo login : yeye / zawzaw</small>
		<?php 
		if(empty($errors) === false){
			echo '<p>' . implode('</p><p class="error">', $errors) . '</p>';	
		}
		?>

		<form method="post" action="">
        	<table><tr><td>Enter Email</td><td>
			<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" />
            </td></tr>
            <tr><td colspan="2" align="center">
			<input type="submit" name="submit" />
            </td></tr>
            </table>

		</form>

	</div>
</body>
</html>