<?php
	$page = "users";
	require_once 'includes/require_login.php';

	require_once 'includes/User.php';
	$userClass = new User();
	$users = $userClass::all();
?>	

<style>
	#userList{
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
	<div id="userList" class="flex-layout wrap">
		<?php
			if(count($users) > 0){
				foreach ($users as $i => $user) {
					include('includes/templates/user_item.php');
				}
			}else{
				echo "<p>No users available</p>";
			}
		?>
	</div>

	<?php
		if (isset($_GET['user_id'])) {
			$user = $userClass::find($_GET['user_id']);
            $is_admin = $user->role == 2;
			include('includes/templates/user_preview.php');
		}
	?>
</div>

<?php include('includes/templates/footer.php'); ?>