<?php
	require_once 'includes/Route.php';
	$route = new Route();
	$route->point_one_id = $_POST['point_one'];
	$route->point_two_id = $_POST['point_two'];
	$new_route_id = $route->save();

	$message = "route_creation=";
    $message .= $new_route_id ? "1" : "0";

    header("Location: index.php?".$message);
?>
