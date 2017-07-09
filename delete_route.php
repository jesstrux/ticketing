<?php
	require_once 'includes/Route.php';
	$routeClass = new Route();
	$route = $routeClass::find($_GET['route_id']);
	$action = $_GET['route_action'];

	$deleted_route_id = $route->delete();
	$message = "route_deletion=";
    $message .= $deleted_route_id ? "1" : "0";

    header("Location: routes.php?".$message);
?>
