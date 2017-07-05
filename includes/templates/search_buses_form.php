<?php
    require_once 'includes/Point.php';
    $pointClass = new Point();
    $points = $pointClass::all(); 
?>
<style>
	#searchForm{
		text-align: left;
		justify-content: flex-start;
	}
	.user-input{
		width: calc(50% - 10px);
		margin-bottom: 20px;
		margin-right: 10px;
		position: relative;
	}

	.input-label{
		margin-bottom: 6px;
		font-size: 1.2em
	}

	input, select{
		box-sizing:border-box;
		width: 100%;
		display: block;
		padding: 20px;
		font-size: 1.2em;
	}

	input{
		padding: 16px 20px;
	}

	input[type="submit"]{

	}
</style>
<div style="max-width: 700px; margin: 0 auto; overflow: hidden">
	<h2 class="serif" style="margin-bottom: 32px; margin-left: 12px;">Search for buses,</h2>

	<form id="searchForm" class="flex-layout wrap" action="index.php">
		<div class="user-input flex-layout column">
			<label class="input-label">Starting Point</label>
			<select name="start_point">
				<option value="">Pick an option</option>
				<?php
			        foreach ($points as $point) {
                        echo "<option value='$point->id'>$point->name</option>";
                    }
                ?>
			</select>
		</div>
		<div class="user-input flex-layout column">
			<label class="input-label">Destination Point</label>
			<select name="dest_point">
				<option value="">Pick an option</option>
				
                <?php
			        foreach ($points as $point) {
                        echo "<option value='$point->id'>$point->name</option>";
                    }
                ?>
			</select>
		</div>

		<div class="user-input flex-layout column">
			<label class="input-label">Travel Date</label>
			<input type="date" name="travel_date">
		</div>

		<div class="user-input flex-layout column">
			<label class="input-label">Bus Type</label>
			<select name="bus_type">
				<option value="0">Standard</option>
				<option value="1">Semi Luxury</option>
				<option value="2">Luxury</option>
			</select>
		</div>

		<div class="user-input" style="margin-top:10px">
			<input type="reset" value="RESET CHOICES" style="background: #f0f0f0; color: #000;">
		</div>

		<div class="user-input" style="margin-top:10px">
			<input type="submit" value="FIND BUSES" name="search_buses" style="background: #e91e63; color: #fff">
		</div>
	</form>
</div>