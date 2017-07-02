<?php
	$page = "user_buses";

	require_once 'includes/Bus.php';
	require_once 'includes/User.php';
	require_once 'includes/session.php';

	$busClass = new Bus();
	$userClass = new User();
	$owner = $userClass::find($_GET["owner"]);
	$buses = $owner->buses();

	$owner_first = $owner->id == $session->user_id ? "Your" : explode(" ", str_replace(",", "", $owner->name))[0]."'s";

	$page_title = $owner_first . " Buses";

	require_once 'includes/require_login.php';
?>	

<style>
	#busList{
		padding-left: 10px;
		padding-top: 10px;
		min-width: 60%;
		align-self: flex-start;
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

	#busPreviews{
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
			$preview_link = "user_buses.php?owner=$owner->id&";
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