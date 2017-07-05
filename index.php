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
	<?php
		if (isset($_GET['ticket_creation'])) {
			$created = $_GET['ticket_creation'] == 1 ? true : false;
			$alert_type= !$created ? "error" : "success";
			$dismiss_link="index.php";
			$alert_message = !$created ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
			$alert_message .= $created ? "Ticket successfully created." : "Sorry, ticket couldn't be created.";

			include 'includes/templates/alert.php';
		}
		require_once "includes/templates/home_for_usertype_$user->role.php";
	?>
</div>

<?php include('includes/templates/footer.php'); ?>