<div class="bus-item flex-layout" style="padding:20px 16px;padding-right: 5px;">
	<div class="bus-image flex-layout center-center" style="width: 100px;height: 100px; margin-right:20px; background: #f0f0f0; position: relative; overflow: hidden">
		<img src="assets/images/profile_pictures/<?php echo $bus->owner()->user_photo ?>" style="height: 100%; min-width: 100%">
	</div>
	<div class="flex-layout column" style="flex:1">
		<h3 class="bus-title" styl="margin-bottom: -8px">
			<span class="item-title sans-serif" style="font-weight: normal; display: block">
				DEPARTURE
			</span>
			<span class="serif" style="font-size: 1.3em; line-height: 1.5em"><?php echo $bus->start_time() ?></span>
		</h3>
		
		<div class="flex-layout" style="align-items: flex-end;">
			<div class="bus-time" style="margin-bottom: 0; padding-bottom: 0; padding-top: 0">
				<span class="item-title sans-serif" style="font-weight: normal; display: block">
					COST
				</span>
				<span class="serif"><?php echo number_format($bus->price) ?></span>
			</div>

			<div class="flex-layout" style="margin-left: auto; padding-right:0; margin-right:0;">
				<a href="<?php echo $preview_link?>bus_id=<?php echo $bus->id ?>">VIEW SEATS</a>&emsp;
			</div>
		</div>
	</div>
</div>