<?php
	require_once 'includes/User.php';
	require_once 'includes/Point.php';
	require_once 'includes/Route.php';
	require_once 'includes/Bus.php';
	require_once 'includes/Ticket.php';
	// require_once 'includes/database.php';

	$ticket = new Ticket();
	$bus = new Bus();
	$user = new User();
	$route = new Route();
	$point = new Point();

	$tickets = $ticket::get_where("TRUE group by date, bus_id order by date desc");
	$buses   = $bus::all();
	$users   = $user::all();
	$routes  = $route::all();
	$points  = $point::all();

	echo "<h1>TICKETS</h1>";
	foreach ($tickets as $i => $ticket) {
		echo "
			<p>
				$i. ".$ticket->user()->name . ", 
				<strong>" .$ticket->bus()->owner()->name . "</strong> ".$ticket->seat_number().
			" - ". nicetime($ticket->date) ."</p>";
	}
	echo "<br>";
?>