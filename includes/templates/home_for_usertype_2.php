<?php
	require_once 'includes/User.php';
	require_once 'includes/Bus.php';
	require_once 'includes/Ticket.php';
	require_once 'includes/Route.php';
	require_once 'includes/Point.php';

	$userClass = new User();
	$users = $userClass::all();
	$busClass = new Bus();
	$buses = $busClass::all();
	$ticketClass = new Ticket();
	$tickets = $ticketClass::all();
	$routeClass = new Route();
	$routes = $routeClass::all();
	$pointClass = new Point();
	$points = $pointClass::all();

	$summary = [
		["group" => "Users","count" => count($users), "link" => "users.php"],
		["group" => "Buses","count" => count($buses), "link" => "buses.php"],
		["group" => "Tickets sold","count" => count($tickets), "link" => "tickets.php"],
		["group" => "Routes","count" => count($routes), "link" => "routes.php"],
		["group" => "End points","count" => count($points), "link" => "points.php"]
	];
?>
<div>
	<h2 class="serif" style="line-height:1em; font-size: 2em">Site summary,</h2>
	<p class="sans-serif" style="font-size: 1.2em; font-weight: normal;">
		Here is some summarized information about the site. <br>
	</p>
	<div class="flex-layout wrap">
		<?php
			foreach ($summary as $key => $item) {
				echo '
					<div class="summary-card">
						<div class="card-content">
							<span class="card-count serif">'.$item['count'].'</span>
							<span class="card-title sans-serif">'.$item['group'].'</span>
						</div>
						<a href="'.$item['link'].'" class="card-link serif">view all</a>
					</div>
				';
			}
		?>
	</div>
</div>