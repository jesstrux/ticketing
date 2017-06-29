<?php
	require_once 'includes/session.php';

	if($session->is_logged_in()){
		$user = $session->get_user();
	}
	else{
		header("Location: login.php");
	}

	$page = "home";

	include('includes/templates/header.php');
?>	

<div style="max-width: 75%; margin: 30px auto;">
	<div>
		<h2 class="serif" style="margin-bottom: -3px">Hello <?php echo $user->name ?>,</h2>
		<p class="sans-serif" style="font-size: 1.2em; line-height: 1.5em; font-family: verdana; font-weight: normal;">
			Welcome to BBPT, if this is your first time please see the <a href="#gettingStarted" style="color: #e91e63;">getting started</a> part where we show you how to use this system. <br><br>
		</p>
	</div>
</div>

<?php include('includes/templates/footer.php'); ?>