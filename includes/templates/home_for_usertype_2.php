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


<?php
	if (isset($_GET['route_creation'])) {
		$created = $_GET['route_creation'] == 1 ? true : false;
		$alert_type= !$created ? "error" : "success";
		$dismiss_link= "index.php";
		$alert_message = !$created ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $created ? "Route successfully created." : "Sorry, route couldn't be created.";

		include 'includes/templates/alert.php';
	}

	if (isset($_GET['point_creation'])) {
		$created = $_GET['point_creation'] == 1 ? true : false;
		$alert_type= !$created ? "error" : "success";
		$dismiss_link= "index.php";
		$alert_message = !$created ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $created ? "Location successfully created." : "Sorry, location couldn't be created.";

		include 'includes/templates/alert.php';
	}


	if (isset($_GET['user_removal'])) {
		$created = $_GET['user_removal'] == 1 ? true : false;
		$alert_type= !$created ? "error" : "success";
		$dismiss_link= "index.php";
		$alert_message = !$created ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $created ? "User successfully deleted." : "Sorry, couldn't delete user.";

		include 'includes/templates/alert.php';
	}
?>
<div>
	<button class="rounded-btn" onclick="openModal('newRouteModal')">CREATE ROUTE</button>&nbsp;&nbsp;
	<button class="rounded-btn" onclick="openModal('newPointModal')">CREATE LOCATION</button>&nbsp;&nbsp;
	<!--<button class="rounded-btn" onclick="openModal('deleteUserModal')">DELETE A USER</button>-->

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

<div id="newPointModal" class="modal">
	<div class="modal-content" style="max-width: 450px">
		<div class="modal-title">
			<h3 class="title">New Point</h3>
		</div>
		<form action="save_point.php" method="POST" id="newPointForm" onsubmit="savePoin(event)">
			<div class="modal-body" style="padding-top: 10px; padding-bottom: 17px;">
				<div class="input-group">
					<label for="name">Location</label>
					<input type="text" id="name" name="name" placeholder="Eg. Arusha">
				</div>

				<div class="input-group">
					<label for="code">Code</label>
					<input type="text" id="code" name="code" placeholder="(capital letters)Eg. ARS">
				</div>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeModal('newPointModal')">CANCEL</button>
				<button type="submit">SUBMIT</button>
			</div>
		</form>
	</div>
</div>

<div id="newRouteModal" class="modal">
	<div class="modal-content" style="max-width: 450px">
		<div class="modal-title">
			<h3 class="title">New Route</h3>
		</div>
		<form action="save_route.php" method="POST" id="newRouteForm" onsubmit="saveRout(event)">
			<div class="modal-body" style="padding-top: 10px; padding-bottom: 17px;">
					<?php include('includes/templates/create_route_form.php') ?>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeModal('newRouteModal')">CANCEL</button>
				<button type="submit">SUBMIT</button>
			</div>
		</form>
	</div>
</div>


<div id="deleteUserModal" class="modal">
	<div class="modal-content" style="max-width: 450px">
		<div class="modal-title">
			<h3 class="title">Delete User</h3>
		</div>
		<form action="delete_user.php" method="POST" id="deleteUserForm" onsubmit="deleteUse(event)">
			<div class="modal-body" style="padding-top: 10px; padding-bottom: 17px;">
					<?php include('includes/templates/delete_user_form.php') ?>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeModal('deleteUserModal')">CANCEL</button>
				<button type="submit">DELETE</button>
			</div>
		</form>
	</div>
</div>

<script>
	function openModal(id){
		var modal = document.getElementById(id);
		modal.classList.add('open');
	}

	function closeModal(id){
		var modal = document.getElementById(id);
		modal.classList.remove('open');
	}
</script>
