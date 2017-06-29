<?php
	$page = "buses";
	require_once 'includes/require_login.php';

	require_once 'includes/Bus.php';
	$busClass = new Bus();

	if($user->role==2)
		$buses = $busClass::all();
	elseif ($user->role==1)
		$buses = $user->buses();
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
			foreach ($buses as $i => $bus) {
				include('includes/templates/bus_item.php');
			}
		?>
	</div>

	<?php
		if (isset($_GET['bus_id'])) {
			$bus = $busClass::find($_GET['bus_id']);
			include('includes/templates/bus_preview.php');
		}
	?>
</div>

<?php include('includes/templates/footer.php'); ?>