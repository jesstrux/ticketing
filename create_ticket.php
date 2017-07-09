<?php
    require_once 'includes/Ticket.php';
	$ticket = new Ticket();

    $ticket->user_id = $_POST['user_id'];
    $ticket->bus_id = $_POST['bus_id'];
    $ticket->seat_position = $_POST['seat_position'];
    $ticket->date = $_POST['date'];

    $new_ticket = $ticket->save();

    if($new_ticket){
    	header("Location: view_ticket.php?ticket_id=$new_ticket");
    }
    else{
    	$message = "ticket_creation=0";
    	header("Location: index.php?$message");
    }
?>
