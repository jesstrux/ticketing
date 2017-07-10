<?php
	require_once 'includes/Point.php';
	
	if(isset($_POST['id'])){
		$pointClass = new Point();
		$point = $pointClass::find(isset($_POST['id']));
	}else{
		$point = new Point();
	}
	
	$point->name = $_POST['name'];
	$point->code = $_POST['code'];
	$new_point_id = $point->save();

	$message = "point_creation=";
    $message .= $new_point_id ? "1" : "0";

    if(isset($_POST['id'])) $location = 'points.php';
	else $location = 'index.php';
	
    header("Location: $location?".$message);
?>
