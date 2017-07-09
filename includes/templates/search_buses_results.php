<?php
	require_once 'includes/Bus.php';
	require_once 'includes/database.php';

	$busClass = new Bus();
	$start_point = $_GET['start_point'];
	$dest_point = $_GET['dest_point'];
	$travel_date = isset($_GET['travel_date']) ? $_GET['travel_date'] : null;
	// $bus_type = $_GET['bus_type'];

	$iq =  "SELECT b.id 
			FROM buses b 
			JOIN routes r ON b.route_id = r.id 
			WHERE r.point_one_id = $start_point AND r.point_two_id = $dest_point AND direction = 0
			OR r.point_two_id = $start_point AND r.point_one_id = $dest_point AND direction = 1
	";

	$sql = "id IN ($iq) ORDER BY price, start_hour";
	$buses = $busClass->get_where($sql);

	// $full_query = "SELECT * FROM buses WHERE id IN ($iq);";
	// $result = $database->query($full_query);
?>

<style>
	#searchForm{
		text-align: left;
		justify-content: flex-start;
	}
</style>
<div style="max-width: 700px; margin: 0 auto; overflow: hidden;">
	<?php
		echo '<a href="javascript:history.go(-1)" style="margin-right: 20px; line-height: 20px; text-decoration: none;">
			GO BACK
		</a>';

		if($buses != null && count($buses) > 0){
			$preview_link = "index.php?travel_date=".$travel_date."&";
			echo '<h2 class="serif" style="margin-bottom: 32px;">Affordable buses,</h2>
			<div class="flex-layout column">';

			foreach ($buses as $i => $bus) {
				if($i < 3){
					include('includes/templates/bus_item_wide.php');
				}
			}

			echo '</div><br><br><br>';

			if(count($buses) > 3){
				echo '<h2 class="serif" style="margin-bottom: 32px;">Other buses,</h2>
				<div class="flex-layout column">';

				foreach ($buses as $i => $bus) {
					if($i > 3){
						include('includes/templates/bus_item_wide.php');
					}
				}

				echo '</div>';
			}
		}else{
			echo '<h2 class="serif" style="margin-bottom: 32px; margin-lef: 12px;">Sorry, no buses available.</h2>';
		}
	?>
</div>
