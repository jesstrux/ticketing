<?php
	require_once 'includes/Bus.php';
	$bus = new Bus();
	$bus->owner_id = $_POST['owner_id'];
	$bus->start_hour = $_POST['start_hour'];
	$bus->start_min = $_POST['start_min'];
	$bus->type = $_POST['type'];
	$bus->route_id = $_POST['route_id'];
	$bus->price = $_POST['price'];
	$bus->seat_style = $_POST['seat_style'];
	$bus->seat_count = $_POST['seat_count'];

	$bus->direction = 0;

	$new_bus_id = $bus->save();
	// if($new_bus_id){
	// 	$busClass = new Bus();
	// 	$new_bus = $busClass::find($new_bus_id);
	// 	echo json_encode($new_bus);
	// }else{
	// 	echo json_encode("Couldn't save bus!!");
	// }

	$message = "bus_creation=";
    $message .= $new_bus_id ? "1" : "0";

    header("Location: ".$_POST['back_link']."&".$message);
?>
