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
	<?php
		if (isset($_GET['manage_admin'])) {
			$created = $_GET['old_role'] == 2 ? true : false;
			$managed = $_GET['manage_admin'] == 1 ? true : false;

			$alert_type= !$managed ? "error" : "success";
			$dismiss_link="users.php";
			$alert_message = !$managed ? "<strong>Error!</strong> " : "<strong>Success!</strong> ";

			if($created)
				$alert_message .= $managed ? "User successfully made admin." : "Sorry, couldn't make user admin.";
			else
				$alert_message .= $managed ? "Admin role successfully removed." : "Sorry, couldn't remove admin role.";

			include 'includes/templates/alert.php';
		}
	?>

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
