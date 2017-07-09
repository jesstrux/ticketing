<?php
	require_once 'includes/Point.php';
	$point = new Point();
	$point->name = $_POST['name'];
	$point->code = $_POST['code'];
	$new_point_id = $point->save();

	$message = "point_creation=";
    $message .= $new_point_id ? "1" : "0";

    header("Location: index.php?".$message);
?>
