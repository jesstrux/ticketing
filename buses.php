<?php
	$page = "buses";
	require_once 'includes/require_login.php';

	require_once 'includes/Bus.php';
	$busClass = new Bus();

	$buses = $busClass::all();
?>	

<style>
	#busList{
		padding-left: 10px;
		padding-top: 10px;
		min-width: 60%;
	}

	.bus-item{
		width: calc(33.333% - 10px);
		margin-bottom: 10px;
		margin-right: 10px;
		border: 1px solid #ccc;
		box-shadow:none;
		min-height:0;
		align-self: flex-start;
		padding-bottom:30px
	}

	#busPreview{
		-ms-align-self: flex-start;
		align-self: flex-start;
		margin-left: 30px;
		margin-top: 10px;
		min-width: 40%;
	}
</style>

<div class="flex-layout">
	<div id="busList" class="flex-layout wrap">
		<?php
			$preview_link = "buses.php?";
			if(count($buses) > 0){
				foreach ($buses as $i => $bus) {
					include('includes/templates/bus_item.php');
				}
			}else{
				echo "<p>No buses available</p>";
			}
		?>
	</div>

	<?php
		// $reserved_seats = ["C2"];
		if (isset($_GET['bus_id'])) {
			$bus = $busClass::find($_GET['bus_id']);
			include('includes/templates/bus_preview.php');
		}
	?>
</div>

<?php include('includes/templates/footer.php'); ?>