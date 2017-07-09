<?php
	require_once 'includes/Route.php';

	if(isset($_POST['route_id'])){
		$routeClass = new Route();
		$route = $routeClass::find($_POST['route_id']);
	}else{
		$route = new Route();
	}

	$route->point_one_id = $_POST['point_one'];
	$route->point_two_id = $_POST['point_two'];
	$new_route_id = $route->save();

	$message = "route_creation=";
    $message .= $new_route_id ? "1" : "0";

    if(isset($_POST['route_id'])){
		header("Location: routes.php?".$message);
	}else{
		header("Location: index.php?".$message);
	}
?>
