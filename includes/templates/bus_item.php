<div class="bus-item flex-layout column">
	<h3 class="bus-title">
		<span><?php echo $bus->route()->point_one()->code ?></span>
		&nbsp;TO&nbsp;
		<span><?php echo $bus->route()->point_two()->code ?></span>
	</h3>
	
	<div class="bus-time">
		<div class="title">
			START TIME
		</div>
		<span><?php echo $bus->start_time ?></span>
	</div>

	<div class="flex-layout">
		<a href="buses.php?bus_id=<?php echo $bus->id ?>">PREVIEW</a>&emsp;
	</div>
</div>