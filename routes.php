<?php
	$page = "routes";
	require_once 'includes/require_login.php';

	require_once 'includes/Route.php';
	$route = new Route();
	$routes = $route::all();
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

<?php include('includes/templates/footer.php'); ?>