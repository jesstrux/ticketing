<style>
	#userPreview{
		box-sizing: border-box;
		padding: 20px;
		background:#fff;
		margin-left: 30px;
		margin-top: 10px;
		box-shadow: 0 0 1px rgba(0,0,0,0.7);
		border: 1px solid #ccc;
	}
</style>
<?php
	$user_type_map = ["user","owner", "admin"];
	$user_type = $user_type_map[$p_user->role];
?>
<form id="userPreview" type="<?php echo $user_type;?>">
	<h3><?php echo $p_user->name; ?></h3>
	<p>
		ROLE: <em><?php echo $user_type; ?></em>
	</p>
	
	<div id="otherInfo" class="flex-layout wrap">
		
	</div>
</form>