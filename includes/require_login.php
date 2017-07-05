<?php
	require_once 'session.php';

	if($session->is_logged_in()){
		$user = $session->get_user();
	}
	else{
		header("Location: login.php");
	}

	include('templates/header.php');
?>