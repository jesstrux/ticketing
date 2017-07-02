<style>
	#busPreview{
		-webkit-perspective: 1800px;
		perspective: 1800px;
		box-sizing: border-box;
		padding: 20px;
		background:#fff;
		margin-left: 30px;
		margin-top: 10px;
		box-shadow: 0 0 1px rgba(0,0,0,0.7);
		border: 1px solid #ccc;
	}

	.seat{
		margin: 8px;
		margin-left: 0;
		box-shadow: 0 0 1px rgba(0,0,0,0.4);
		border: 1px solid #ccc;
		box-sizing:border-box;
		text-align:center;
		padding: 5px 0;
	}

	.seat-spacer{
		min-width: 10%;
	}

	#busPreview[type="st"] .seat{
		min-width: calc(18% - 8px);
	}

	#busPreview[type="lu"] .seat{
		min-width: calc(22.5% - 8px)
	}

	.seat img{
		display: block
	}

	.seat.reserved{
		pointer-events:none;
		background: #eee;
		color:#aaa;
	}

	.seat.reserved svg{
		fill: #ccc;
	}

	.seat-checker:checked + label{
		background: lightgreen;
	}
</style>
<?php
	$seat_style_map=["lu","st"];
	$seat_style=$seat_style_map[$bus->seat_style];
	if(!isset($reserved_seats))
		$reserved_seats=[];
?>
<form id="busPreview" type="<?php echo $seat_style;?>" action="<?php echo $action_url;?>">
	<div class="flex-layout center" style="margin-bottom:30px; margin-top: 20px">
		<img src="assets/images/profile_pictures/<?php echo $bus->owner()->user_photo?>" width="80px" height="80px">
		<h3 style="margin-left: 20px"><?php echo $bus->owner()->name;?></h3>
		<input type="hidden" name="bus" value="<?php echo $bus->id ?>" />

		<?php
			if(isset($_GET['travel_date']))
				echo '<input type="hidden" name="travel_date" value="'. $_GET['travel_date'] .'" />';
		?>

		<input id="submitBtn" disabled name="seat_chosen" value="DONE" type="submit" style="display: non; padding: 10px 30px; margin-left: auto; margin-right: 10px">
	</div>
	<div id="seats" class="flex-layout wrap">
		<?php
			foreach ($bus->seats() as $i=>$seat) {
				$uiClass = in_array($seat->number, $reserved_seats) ? "reserved" : "";

				echo '<input value="'.$seat->position.'" type="radio" name="chosen_seat" id="'.$seat->number.'" style="display:none; position: absolut" class="seat-checker" onchange="onChange(this)"/>';

				echo '<label for="'.$seat->number.'" class="seat '.$uiClass.' flex-layout column center-center">
					<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<defs>
							<path d="M0 0h24v24H0V0z" id="a"/>
						</defs>
						<clipPath id="b">
							<use overflow="visible" xlink:href="#a"/>
						</clipPath>
						<path clip-path="url(#b)" d="M4 18v3h3v-3h10v3h3v-6H4zm15-8h3v3h-3zM2 10h3v3H2zm15 3H7V5c0-1.1.9-2 2-2h6c1.1 0 2 .9 2 2v8z"/>
					</svg>

					'.$seat->number.'
				</label>';

				if(substr($seat->number, strlen($seat->number)-1)=="2"){
					echo "<div class='seat-spacer'></div>";
				}
			}	
		?>
	</div>
</form>