<?php
	$page = "routes";
	require_once 'includes/require_login.php';

	require_once 'includes/Route.php';
	require_once 'includes/Point.php';

	$route = new Route();
	$routes = $route::all();

	$point = new Point();
	$points = $point::all();
?>	

<style>
	#routeList{
		padding-left: 10px;
		padding-top: 10px;
	}

	.route-item{
		width: calc(33.333% - 10px);
		margin-bottom: 10px;
		margin-right: 10px;
	}
</style>

<!-- route_deletion -->
<?php
	if (isset($_GET['route_creation'])) {
		$changed = $_GET['route_creation'] == 1 ? true : false;

		$alert_type= !$changed ? "error" : "success";
		$dismiss_link="routes.php";
		$alert_message = !$changed ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $changed ? "Route successfully changed." : "Sorry, couldn't change route.";

		include 'includes/templates/alert.php';
	}

	if (isset($_GET['route_deletion'])) {
		$deleted = $_GET['route_deletion'] == 1 ? true : false;

		$alert_type= !$deleted ? "error" : "success";
		$dismiss_link="routes.php";
		$alert_message = !$deleted ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $deleted ? "Route successfully deleted." : "Sorry, couldn't delete route.";

		include 'includes/templates/alert.php';
	}
?>

<div id="routeList" class="flex-layout wrap" style="max-width: 1200px; margin: 30px auto;">
	<?php
		if(count($routes) > 0){
			foreach ($routes as $i => $route) {
				include('includes/templates/route_item.php');
			}
		}else{
			echo "<p>No routes available</p>";
		}
	?>
</div>

<div id="editRouteModal" class="modal">
	<div class="modal-content" style="max-width: 450px">
		<div class="modal-title">
			<h3 class="title">Edit Route</h3>
		</div>
		<form action="save_route.php" method="POST" id="newRouteForm" onsubmit="saveRout(event)">
			<div class="modal-body" style="padding-top: 10px; padding-bottom: 17px;">
				<?php 
					$edit_route = true;
					include('includes/templates/create_route_form.php');
				?>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeModal('editRouteModal')">CANCEL</button>
				<button type="submit">SAVE CHANGES</button>
			</div>
		</form>
	</div>
</div>

<script>
	function editRoute(r, p1, p2){
		var route = document.getElementById("route_id");
		var point_one = document.getElementById("point_one");
		var point_two = document.getElementById("point_two");

		route.value = r;
		point_one.value = p1;
		point_two.value = p2;

		openModal("editRouteModal");
	}
</script>

<?php include('includes/templates/footer.php'); ?>
