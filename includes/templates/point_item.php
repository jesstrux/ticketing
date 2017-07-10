<div class="route-item flex-layout column">
	<div class="title">
			POINT CODE
		</div>
	<h3 class="route-title">
		<span><?php echo $point->code ?></span>
	</h3>
	<div class="title">
		POINT NAME
	</div>
	<h3 class="route-title">
		<span><?php echo $point->name ?></span>
	</h3>

	<div class="flex-layout">
		<a href="javascript:void(0);" onclick="editPoint(<?php echo $point->id .",'". $point->name ."','". $point->code . "'";?>)">CHANGE</a>&emsp;
		<a href="delete_point.php?point_id=<?php echo $point->id ?>">REMOVE</a>
	</div>
</div>
