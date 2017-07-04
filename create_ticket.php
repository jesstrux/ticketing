<?php
    require_once 'includes/Ticket.php';
	$ticket = new Ticket();

    $ticket->user_id = $_POST['user_id'];
    $ticket->bus_id = $_POST['bus_id'];
    $ticket->seat_position = $_POST['seat_position'];
    $ticket->date = $_POST['date'];

    $message = "ticket_creation=";
    $message .= $ticket->save() ? "1" : "0";

    header("Location: index.php?$message");
?>