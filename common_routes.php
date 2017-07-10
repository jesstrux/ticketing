<?php
	$page = "Common Routes";
	require_once 'includes/require_login.php';

	require_once 'includes/Route.php';
	require_once 'includes/Point.php';

	$route = new Route();
	$routList = $route::all();
	$routes = [];

	foreach ($routList as $route) {
		if($route->buses() && count($route->buses()) > 1){
			$routes[] = $route;
		}
	}
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

	.route-item .title{
		font-size: 0.8em;
	}

	.route-item .route-point span{
		font-size: 1.4em;
		/*font-weight: bold;*/
		display: inline-block;
	}

	.route-item .route-point:first-child span{
		margin-bottom: 16px;
	}
</style>


<div id="routeList" class="flex-layout wrap" style="max-width: 1200px; margin: 30px auto;">
	<?php
		if(count($routes) > 0){
			foreach ($routes as $route) {
				echo '
					<div class="route-item flex-layout column">
						<h3 class="route-title">
							<span>'. $route->point_one()->name .'</span>
							&nbsp;TO&nbsp;
							<span>'. $route->point_two()->name .'</span>
						</h3>
						<div class="route-points flex-layout">
							'. count($route->buses()) .' buses go on this route
						</div>

						<div class="flex-layout">
							<a href="index.php?search_buses=true&start_point='. $route->point_one_id .'&dest_point='. $route->point_two_id .'">VIEW BUSES</a>
						</div>
					</div>
				';
			}
		}else{
			echo "<p>No routes available</p>";
		}
	?>
</div>

<?php include('includes/templates/footer.php'); ?>
