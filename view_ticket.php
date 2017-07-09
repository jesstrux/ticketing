<?php
	require_once 'includes/session.php';

	if($session->is_logged_in()){
		$user = $session->get_user();
	}
	else{
		header("Location: login.php");
	}

	$page = "Print Ticket";

	include('includes/templates/header.php');
?>	

<div style="max-width: 85%; margin: 30px auto;">
	<?php
		if (isset($_GET['ticket_saved'])) {
			$alert_type= !$created ? "error" : "success";
			$dismiss_link="view_ticket.php?ticket_id=".$_GET['ticket_id'];
			$alert_message = "<strong>Success!</strong> ";
			$alert_message .= "Seat successfully booked.";

			include 'includes/templates/alert.php';
			print_r($ticket);
		}else{
			if(isset($_GET['ticket_id'])){
				require_once "includes/Ticket.php";
				$ticketClass = new Ticket();
				$ticket = $ticketClass::find($_GET['ticket_id']);
			}
		}
	?>

	<img id="ticketContent" src="" alt="" styl="box-shadow: 0 0 23px rgba(0,0,0,0.1)"><br>
	<a id="ticketDownloader" style="display: inline-block; background: #000; color: #f4f4f4; text-decoration: none; margin-top: 23px; padding: 12px 20px; box-shadow: 0 0 13px rgba(0,0,0,0.15)" download="bbpt_bus_ticket.png">PRINT TICKET</a>
</div>

<script>
	var _c = document.createElement("canvas");
	var _ctx = _c.getContext("2d");
	_c.width = 161;
	_c.height = 61;

	_ctx.fillStyle="rgba(25,25,25,1)";
	_ctx.font = "bold 20px Georgia";
	_ctx.fillText("BBPT", 30, 38);

	_ctx.fillStyle="rgba(25,25,25,0.4)";
	_ctx.moveTo(116, 30);
	_ctx.lineTo(106, 50);
	_ctx.lineTo(126, 80);
	_ctx.fill();

	var ticketContent = document.getElementById("ticketContent");
	var ticketDownloader = document.getElementById("ticketDownloader");
	var canvas = document.createElement("canvas");
	var ctx = canvas.getContext("2d");

	canvas.width = 600;
	canvas.height = 250;

	ctx.save();
	ctx.shadowBlur = 60;
	ctx.shadowColor = "rgba(25,25,25,0.3)";
	ctx.fillStyle="#9C27B0";
	ctx.fillRect(10, 10, canvas.width - 20, canvas.height - 20);
	ctx.restore();

	var pattern = ctx.createPattern(_c, "repeat");
	ctx.fillStyle=pattern;

	ctx.save();
	ctx.globalAlpha = 0.08;
	ctx.fillRect(0, 0, canvas.width, canvas.height);
	ctx.restore();

	ctx.fillStyle="#F3E5F5";
	ctx.font = "30px Lobster";
	ctx.fillText("<?php echo $ticket -> bus_str() ?>", 140, 60);

	ctx.font = "14px Verdana";
	ctx.fillText("PASSENGER:", 40, 110);
	ctx.fillText("ROUTE:", 40, 140);
	ctx.fillText("DATE:", 40, 170);
	ctx.fillText("TIME:", 245, 170);
	ctx.fillText("COST:", 40, 200);
	
	ctx.font = "bold 20px Georgia";
	ctx.fillText("<?php echo $ticket -> passenger() ?>", 140, 110);

	ctx.font = "bold 16px Georgia";
	ctx.fillText("<?php echo $ticket -> route_str() ?>", 100, 140);
	ctx.fillText("<?php echo $ticket -> date_str() ?>", 90, 170);
	ctx.fillText("<?php echo $ticket -> time() ?>", 290, 170);
	ctx.fillText("<?php echo $ticket -> price() ?>", 90, 200);

	ctx.fillStyle="#F3E5F5";
	ctx.moveTo(480, 10);
	ctx.lineTo(380, canvas.height - 10);
	ctx.lineTo(canvas.width - 10, canvas.height - 10);
	ctx.lineTo(canvas.width - 10, 10);
	ctx.fill();

	ctx.fillStyle="#9226a5";
	ctx.font = "14px Verdana";
	ctx.fillText("SEAT No", 480, 170);

	ctx.font = "bold 56px Georgia";
	ctx.fillText("<?php echo $ticket -> seat_number() ?>", 480, 140);

	ticketContent.src = canvas.toDataURL("image/png");
	ticketDownloader.setAttribute("href", canvas.toDataURL("image/png"));
	var url = ticketContent.src.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

	function downloadTicket(){
		window.open(canvas.toDataURL("image/png"));
	}
</script>

<?php include('includes/templates/footer.php'); ?>
