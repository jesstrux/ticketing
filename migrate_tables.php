<?php
	require_once 'includes/User.php';
	require_once 'includes/Point.php';
	require_once 'includes/Route.php';
	require_once 'includes/Bus.php';
	require_once 'includes/Ticket.php';

	$ticket = new Ticket();
	$ticket::migrate_down();

	$bus = new Bus();
	$bus::migrate_down();

	$user = new User();
	$user::migrate_down();
	$user::migrate_up();

	$route = new Route();
	$route::migrate_down();

	$point = new Point();
	$point::migrate_down();
	$point::migrate_up();

	$route::migrate_up();

	$bus::migrate_up();
	$ticket::migrate_up();
?>