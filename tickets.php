<?php
	$page = "tickets";
	require_once 'includes/require_login.php';

	require_once 'includes/Ticket.php';
	$ticket = new Ticket();
	$tickets = $ticket::get_where("TRUE group by date, bus_id order by date desc");
?>	

<style>
	#ticketList{
		padding-left: 5px;
		padding-top: 5px;
	}

	.ticket-item{
		width: calc(25% - 16px);
	}
</style>

<div id="ticketList" class="flex-layout wrap" style="max-width: 1200px; margin: 30px auto;">
	<?php
		if(count($tickets) > 0){
			foreach ($tickets as $i => $ticket) {
				include('includes/templates/ticket_item.php');
			}
		}else{
			echo "<p>No tickets available</p>";
		}
	?>
</div>

<?php include('includes/templates/footer.php'); ?>