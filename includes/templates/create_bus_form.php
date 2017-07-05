<div class="input-group">
	<label for="route_id">Route</label>
	<select id="route_id" name="route_id">
		<?php
			foreach ($routes as $route) {
				$route_str = $route->point_one()->name;
				$route_str .= " - " . $route->point_two()->name;

				echo '<option value="'.$route->id.'">'.$route_str.'</option>';
			}
		?>
	</select>
</div>

<div class="input-group">
	<label for="start_hour">Start Hour</label>
	<select id="start_hour" name="start_hour">
		<?php
			for ($i=1; $i <= 12; $i++) { 
				echo '<option value="'.$i.'">'.l_zero($i).'</option>';
			}
		?>
	</select>
</div>

<div class="input-group">
	<label for="start_min">Start min</label>
	<select id="start_min" name="start_min">
		<?php
			$min_options = [0, 15, 30];
			for ($i=0; $i < count($min_options); $i++) { 
				echo '<option value="'.$min_options[$i].'">'.l_zero($min_options[$i]).'</option>';
			}
		?>
	</select>
</div>

<div class="input-group">
	<label for="seat_style">Type</label>
	<select id="type" name="type">
		<option value="0">Standard</option>
		<option value="1">Semi Luxury</option>
		<option value="2">Luxury</option>
	</select>
</div>

<div class="input-group">
	<label for="seat_style">Seat Style</label>
	<select id="seat_style" name="seat_style">
		<option value="0">Two by Three</option>
		<option value="1">Two by Two</option>
	</select>
</div>

<div class="input-group">
	<label for="seat_count">Seat Count</label>
	<input type="number" placeholder="number of seats">
</div>

<div class="input-group">
	<label for="price">Price</label>
	<input type="number" placeholder="bus fare">
</div>

<input type="hidden" name="owner_id" value="<?php echo $user->id ?>">