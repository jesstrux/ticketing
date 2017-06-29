<div class="route-item flex-layout column">
	<h3 class="route-title">
		<span><?php echo $route->point_one()->code ?></span>
		&nbsp;TO&nbsp;
		<span><?php echo $route->point_two()->code ?></span>
	</h3>
	<div class="route-points flex-layout">
		<div class="route-point">
			<div class="title">
				POINT ONE
			</div>
			<span><?php echo $route->point_one()->name ?></span>
		</div>
		<div style="position: relative; height: 100%; width: 1px; background: #000; align-self: center; margin-left: 8px; margin-right: 8px;"></div>
		<div class="route-point">
			<div class="title">
				POINT TWO
			</div>
			<span><?php echo $route->point_two()->name ?></span>
		</div>
	</div>

	<div class="flex-layout">
		<a href="edit_route.php?route_id=<?php echo $route->id ?>">CHANGE</a>&emsp;
		<a href="delete_route.php?route_id=<?php echo $route->id ?>">REMOVE</a>
	</div>
</div>