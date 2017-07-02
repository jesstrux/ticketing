<div class="bus-item flex-layout column">
	<h3 class="user-name">
		<span><?php echo $user->name ?></span>
	</h3>
	<p>
		<?php $roles = ["User", "Bus Owner", "Admin"]?>
		Role: <?php echo $roles[$user->role] ?>
	</p>

	
	<div class="flex-layout">
		<?php
			if($user->role == 0)
				echo '<a href="make_admin.php?user_id='.$user->id.'">MAKE ADMIN</a>&emsp;';
			else if($user->role == 1)
				echo '<a href="user_buses.php?owner='.$user->id.'">VIEW BUSES</a>&emsp;';
			else if($user->role == 2)
				echo '<a href="remove_admin.php?user_id='.$user->id.'">REMOVE ADMIN</a>&emsp;';
		?>
	</div>
</div>