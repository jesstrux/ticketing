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

<div style="max-width: 85%; margin: 30px auto;">
	<?php require_once "includes/templates/home_for_usertype_$user->role.php"; ?>
</div>

<?php include('includes/templates/footer.php'); ?>