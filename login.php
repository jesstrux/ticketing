<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library IS</title>
	<link rel="stylesheet" href="assets/css/authpages.css">
</head>
<body>
	<?php
		require_once 'includes/session.php';
		if($session->is_logged_in()){
			header("Location: index.php");
		}
		require_once 'includes/User.php';

		if(isset($_POST['submit'])){
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$condition = "username = '$username' AND password = '$password' LIMIT 1";

			$user = new User();
			if($user::exists($condition)){
				$foundUser = $user::findWhere("username = '".$_POST['username']."'");
				$session->login(array_shift($foundUser));
				header("Location: index.php");
			}else{
				header("Location: login.php?login_failed");
			}
		}
	?>
	<form action="login.php" method="POST">
		<div class="round-bg"></div>
		<a class="link" href="register.php">REGISTER</a>
		<div class="form-header">
			<h1>Login</h1>
		</div>

		<?php 
			if(isset($_GET['login_failed'])){
				$alert_type="error";
				$dismiss_link="login.php";
				$alert_message = "<strong>Error!</strong> Wrong username or password. <br>";
				// $alert_message.= 'Not registered yet? Register <a href="register.php';
				include 'includes/templates/alert.php';
			}
			else if(isset($_GET['registered'])){
				$alert_type="success";
				$dismiss_link="login.php";
				$alert_message = "<strong>Success!</strong> Registration successfull.";
			}
		?>
		<div class="input-wrapper">
			<span>Phone Number:</span>
			<input required id="username" name="username" type="text" autocomplete="off">
		</div>
		<div class="input-wrapper">
			<span>Password: </span>
			<input autocomplete="off" required id="password" name="password" type="password">
		</div>
		<div style="margin-bottom: -25px;">&nbsp;</div>
		<button style="margin-top: 20px;" type="reset">Clear Form</button>
		<input type="submit" name="submit" value="LOGIN">&emsp;
	</form>
</body>
</html>