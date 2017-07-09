<?php
	if(isset($edit_route)){
		echo '<input id="route_id" type="hidden" name="route_id">';
	}
?>
<div class="input-group">
	<label for="point_one">Start Point</label>
	<select id="point_one" name="point_one">
		<?php
			foreach ($points as $point) {
				echo '<option value="'.$point->id.'">'.$point->name.'</option>';
			}
		?>
	</select>
</div>

<div class="input-group">
	<label for="point_two">Destination Point</label>
	<select id="point_two" name="point_two">
		<?php
			foreach ($points as $point) {
				echo '<option value="'.$point->id.'">'.$point->name.'</option>';
			}
		?>
	</select>
</div>
