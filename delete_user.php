<?php
	require_once 'includes/User.php';
	$userClass = new User();
	$user = $userClass::find($_POST['user_id']);
	$removed_user_id = $user->delete();

	$message = "user_removal=";
    $message .= $removed_user_id ? "1" : "0";

    header("Location: index.php?".$message);
?>
