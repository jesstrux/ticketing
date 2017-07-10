<?php
	require_once 'includes/Point.php';
	$pointClass = new Point();
	$point = $pointClass::find($_GET['point_id']);
	
	$deleted_point_id = $point->delete();
	$message = "point_deletion=";
    $message .= $deleted_point_id ? "1" : "0";

    header("Location: points.php?".$message);
?>
