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
	}

	.seat{
		margin: 8px;
		margin-left: 0;
		height: 70px;
		box-shadow: 0 0 1px rgba(0,0,0,0.4);
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
</style>
<?php
	$seat_style_map=["lu","st"];
	$seat_style=$seat_style_map[$bus->seat_style];
?>
<div id="busPreview" type="<?php echo $seat_style;?>">
	<h3>TYPE:<?php echo $seat_style;?></h3>
	<div id="seats" class="flex-layout wrap">
		<?php
			foreach ($bus->seats() as $i=>$seat) {
				echo "<div class='seat'>$seat->number</div>";

				if(substr($seat->number, strlen($seat->number)-1)=="2"){
					echo "<div class='seat-spacer'></div>";
				}
			}	
		?>
	</div>
</div>