<?php
	require_once 'includes/User.php';
	$userClass = new User();
	$user = $userClass::find($_GET['user_id']);
	$role = $user->role;
	$user->role = $role == 0 ? 2 : 0;
	$managed_user_id = $user->save();

	$message = "manage_admin=";
    $message .= $managed_user_id ? "1" : "0";
    $message .= "&old_role=";
    $message .= $role == 0 ? 2 : 0;

    header("Location: users.php?".$message);
?>
