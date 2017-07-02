<?php
	require_once 'includes/Bus.php';
	// require_once 'includes/database.php';

	$busClass = new Bus();
	
	if (isset($_GET['seat_chosen'])) {
		$bus = $busClass::find($_GET['bus']);
		$start = $bus->direction == 0 ? $bus->route()->point_one()->name : $bus->route()->point_two()->name;
		$dest = $bus->direction == 1 ? $bus->route()->point_one()->name : $bus->route()->point_two()->name;

		echo '<a href="javascript:history.go(-1)" style="margin-right: 20px; line-height: 20px; text-decoration: none;">
			GO BACK
		</a>';

		echo '<form style="max-width: 600px; margin:auto" method="POST">';
			echo '<input type="hidden" name="user_id" value="'.$user->id.'" />';
			echo '<input type="hidden" name="bus" value="'.$_GET['bus'].'" />';
			echo '<input type="hidden" name="travel_date" value="'.$_GET['travel_date'].'" />';
			
			echo '<h2 class="serif" style="margin-bottom: 12px; margin-lef: 12px;">Verify info,</h2>';
			echo '<p style="font-size: 1em; margin-bottom: 32px" class="sans-serif"> Does everything look good? If so click SUBMIT, otherwise click GO BACK to return to previous pages and make changes.</p>';

			echo '<table border="1" cellpadding="10" style="text-align: left; width: 80%">';
			echo '<tr><th>Travel Date: </th><td>'. $_GET['travel_date'] .'</td></tr>';
			echo '<tr><th>Start: </th><td>'. $start .'</td></tr>';
			echo '<tr><th>Destination: </th><td>'. $dest .'</td></tr>';
			echo '<tr><th>Bus: </th><td>'. $bus->owner()->name .'</td></tr>';
			echo '<tr><th>Seat number: </th><td>'. $bus->get_seat_number($_GET['seat_chosen']) .'</td></tr>';
			echo '<tr><th>Price: </th><td>'. $bus->price .'</td></tr>';
			echo '<tr><td colspan="2" style="text-align: center"><button type="submit" style="padding: 10px; min-width: 200px">SUBMIT</button></td></tr>';
		echo '</table></form>';
	}
	else if (isset($_GET['bus_id'])) {
		$bus = $busClass::find($_GET['bus_id']);
		$action_url = "index.php";
		echo '<a href="javascript:history.go(-1)" style="margin-right: 20px; line-height: 20px; text-decoration: none;">
			GO BACK
		</a>';
		echo '<h2 class="serif" style="margin-bottom: 32px; margin-lef: 12px;">Choose a seat,</h2>';

		echo '<div style="max-width: 600px; margin:auto">';
			include('includes/templates/bus_preview.php');
		echo '</div>';

		echo '<script>
			function onChange(input){
				document.getElementById("submitBtn").removeAttribute("disabled");
				console.log(input);
			}
		</script>';
	}
	else if(isset($_GET['search_buses']))
		include('includes/templates/search_buses_results.php');
	else
		include('includes/templates/search_buses_form.php');	
?>