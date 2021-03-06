<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library IS</title>
	<link rel="stylesheet" href="assets/css/authpages.css">
</head>
<body>
	<?php
		if(isset($_POST['submit'])){
			require_once 'includes/User.php';
			require_once 'includes/FileUploader.php';

			$user = new User();
			$user->name = $_POST['name'];
			$user->username = $_POST['username'];
			$user->password = md5($_POST['password']);
			$user->role = $_POST['role'];

			$dir_path = "assets/images/profile_pictures/";
			$dir_path .= $_POST['role'] == 1 ? "buses/" : "";

			if(isset($_FILES['user_photo']) && $_FILES['user_photo'] != null){
				$fileUploader = new FileUploader("user_photo", $dir_path);
				$upload_file = json_decode($fileUploader->upload());

				if($upload_file->success){
					$user->user_photo = $_POST['role'] == 1 ? "buses/" : "";
					$user->user_photo .= $upload_file->target_file;
				}
				else
					$user->user_photo = "default_dp.png";
			}
			else
				$user->user_photo = "default_dp.png";

			if(!$user->exists("username = '". $_POST['username']."'")){
				if($user->create()){
					header("Location: login.php?registered");
				}else{
					header("Location: register.php?register_failed");
				}
			}else{
				header("Location: register.php?user_exists");
			}
		}

		if(isset($_GET['register_failed'])){
			$alert_type="error";
			$dismiss_link="register.php";
			$alert_message = "<strong>Success!</strong> Registration failed.";
		}else if(isset($_GET['user_exists'])){
			$alert_type="error";
			$dismiss_link="register.php";
			$alert_message = "<strong>Success!</strong> Registration failed.";
		}
	?>
	<form action="register.php" method="POST" style="padding-bottom: 5px;" enctype="multipart/form-data">
		<div class="round-bg"></div>
		<a class="link" href="login.php">LOGIN</a>
		<div class="form-header">
			<h1>Register</h1>
		</div>
		<div>
			<?php
				if(isset($alert_type))
					include 'includes/templates/alert.php';
			?>
		</div>
		<div class="input-wrapper">
			<span>Full Name:</span> 
			<input required id="nname" name="name" type="text" placeholder="eg. Juma Jabu/Ngorika">
		</div>
		<div class="input-wrapper">
			<span>Phone number:</span> <input required id="username" name="username" type="text">
		</div>
		<div class="input-wrapper">
			<span>Password:</span> <input required id="password" name="password" type="password">
		</div>
		<div class="input-wrapper">
			<span>Register As: </span>
			<select name="role" id="role">
				<option value="0">Choose option</option>
				<option value="0">User</option>
				<option value="1">Bus Owner</option>
			</select>
		</div>
		<div class="input-wrapper">
			<span>Picture:</span> <input id="user_photo" name="user_photo" type="file">
		</div>

		<div style="margin-botto: -25px;">&nbsp;</div>
		<input type="submit" name="submit" value="Register Now">&emsp;
		<!-- <button type="reset">Clear Form</button> -->
	</form>
</body>
</html>
