<?php
	$page = "user_buses";

	require_once 'includes/Bus.php';
	require_once 'includes/Route.php';
	require_once 'includes/User.php';
	require_once 'includes/session.php';

	$busClass = new Bus();
	$userClass = new User();
	$routeClass = new Route();
	$owner = $userClass::find($_GET["owner"]);
	$buses = $owner->buses();
	$routes = $routeClass::all();

	$owner_first = $owner->id == $session->user_id ? "Your" : explode(" ", str_replace(",", "", $owner->name))[0]."'s";

	$page_title = $owner_first . " Buses";

	$navBarContent = '<button onclick="openNewbusModal()" class="rounded-btn" style="margin-top: 2px">
							&nbsp;CREATE BUS&nbsp;
						</button>';
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
			if($buses != null){
				foreach ($buses as $i => $bus) {
					include('includes/templates/bus_item.php');
				}
			}else{
				echo "<h3>No buses found!</h3>";
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


<div id="newBusModal" class="modal">
	<div class="modal-content">
		<div class="modal-title">
			<h3 class="title">New Bus</h3>
		</div>
		<form action="#" id="newBusForm" onsubmit="saveBus(event)">
			<div class="modal-body">
					<?php include('includes/templates/create_bus_form.php') ?>
			</div>
			<div class="modal-buttons">
				<button type="reset" onclick="closeNewbusModal()">CANCEL</button>
				<button type="submit">SUBMIT</button>
			</div>
		</form>
	</div>
</div>

<script>
	var modal = document.getElementById('newBusModal');
	
	function openNewbusModal(){
		modal.classList.add('open');
	}

	function closeNewbusModal(){
		modal.classList.remove('open');
	}

	function saveBus(e){
		var form = new FormData(document.getElementById('newBusForm'));

		fetch('create_bus.php',{
			method: 'POST',  
		    headers: {  
		      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"  
		    },  
		    body: form
		})
		.then(function(response) {  
			  	if (response.status !== 200) {  
			    	console.log('Looks like there was a problem. Status Code: ' +  
			      	response.status);  
			    	return;  
			  	}

				// Examine the text in the response  
				response.json().then(function(data) {  
					console.log(data);  
				});  
			}
		)  
		.catch(function(err) {  
			console.log('Fetch Error :-S', err);  
		});
	}
</script>
<?php include('includes/templates/footer.php'); ?>