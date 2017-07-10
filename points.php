<?php
	$page = "points";
	require_once 'includes/require_login.php';

	require_once 'includes/Point.php';

	$point = new Point();
	$points = $point::all();
?>	

<style>
	#pointList{
		padding-left: 10px;
		padding-top: 10px;
	}

	.route-item{
		width: calc(33.333% - 10px);
		margin-bottom: 10px;
		margin-right: 10px;
	}

	.route-item .title{
		font-size: 0.8em;
	}

	.route-item .route-title{
		margin-bottom: 10px;
	}
</style>

<!-- point_deletion -->
<?php
	if (isset($_GET['point_creation'])) {
		$changed = $_GET['point_creation'] == 1 ? true : false;

		$alert_type= !$changed ? "error" : "success";
		$dismiss_link="points.php";
		$alert_message = !$changed ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $changed ? "Point successfully changed." : "Sorry, couldn't change point.";

		include 'includes/templates/alert.php';
	}

	if (isset($_GET['point_deletion'])) {
		$deleted = $_GET['point_deletion'] == 1 ? true : false;

		$alert_type= !$deleted ? "error" : "success";
		$dismiss_link="points.php";
		$alert_message = !$deleted ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";
		$alert_message .= $deleted ? "Point successfully deleted." : "Sorry, couldn't delete point.";

		include 'includes/templates/alert.php';
	}
?>

<div id="pointList" class="flex-layout wrap" style="max-width: 1200px; margin: 30px auto;">
	<?php
		if(count($points) > 0){
			foreach ($points as $i => $point) {
				include('includes/templates/point_item.php');
			}
		}else{
			echo "<p>No points available</p>";
		}
	?>
</div>

<div id="editPointModal" class="modal">
	<div class="modal-content" style="max-width: 450px">
		<div class="modal-title">
			<h3 class="title">Edit Point</h3>
		</div>
		<form action="save_point.php" method="POST" id="newPointForm" onsubmit="savePoin(event)">
			<input type="hidden" id="pointId" name="id">

			<div class="modal-body" style="padding-top: 10px; padding-bottom: 17px;">
				<div class="input-group">
					<label for="name">Location</label>
					<input type="text" id="pointName" name="name" placeholder="Eg. Arusha">
				</div>

				<div class="input-group">
					<label for="code">Code</label>
					<input type="text" id="pointCode" name="code" placeholder="(capital letters)Eg. ARS">
				</div>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeModal('editPointModal')">CANCEL</button>
				<button type="submit">SAVE CHANGES</button>
			</div>
		</form>
	</div>
</div>

<script>
	function editPoint(id, name, code){
		var point = document.getElementById("pointId");
		var point_name = document.getElementById("pointName");
		var point_code = document.getElementById("pointCode");

		point.value = id;
		point_name.value = name;
		point_code.value = code;

		openModal("editPointModal");
	}
</script>

<?php include('includes/templates/footer.php'); ?>
