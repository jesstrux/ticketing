<?php
	require_once 'includes/User.php';
	require_once 'includes/Bus.php';
	require_once 'includes/Ticket.php';
	require_once 'includes/Route.php';
	require_once 'includes/Point.php';

	$busClass = new Bus();
	$buses = $busClass::get("owner_id", $user->id);
	$ticketClass = new Ticket();
	$tickets = $ticketClass::get_where("bus_id IN (SELECT id FROM buses WHERE owner_id = $user->id)");
	$routeClass = new Route();
	$routes = $routeClass::get_where("id IN (SELECT route_id FROM buses WHERE owner_id = $user->id)");

	$summary = [
		["group" => "Buses","count" => count($buses), "link" => "user_buses.php?owner=$user->id"],
		["group" => "Tickets sold","count" => count($tickets)],
		["group" => "Routes Covered","count" => count($routes)]
	];
?>
<div>
	<h2 class="serif" style="line-height:1em; font-size: 2em">Company summary,</h2>
	<p class="sans-serif" style="font-size: 1.2em; font-weight: normal;">
		Here is some summarized information about yuor company. <br>
	</p>
	<div class="flex-layout wrap">
		<?php
			foreach ($summary as $key => $item) {
				echo '
					<div class="summary-card">
						<div class="card-content">
							<span class="card-count serif">'.$item['count'].'</span>
							<span class="card-title sans-serif">'.$item['group'].'</span>
						</div>';
				echo isset($item['link']) ? '<a href="'.$item['link'].'" class="card-link serif">view all</a>': '';
				echo '</div>';
			}
		?>
	</div>
</div>