<div class="input-group">
	<label for="user_id">Choose User</label>
	<select id="user_id" name="user_id">
		<?php
			foreach ($users as $user) {
				echo '<option value="'.$user->id.'">'.$user->name.'</option>';
			}
		?>
	</select>
</div>
