<div class="ticket-item flex-layout column cente">
	<div class="upper flex-layout column">
		<h3 class="serif"><?php echo $ticket->bus()->owner()->name ?></h3>

		<div class="trip-route flex-layout sans-serif">
			<span><?php echo $ticket->route()->point_one()->code ?></span>
			&nbsp;TO&nbsp;
			<span><?php echo $ticket->route()->point_two()->code ?></span>
		</div>

		<div class="seat-number flex-layout center-center sans-serif">
			<?php echo $ticket->seat_number() ?>
		</div>
	</div>
	<div class="ticket-info">
		<div class="item-title sans-serif">Passenger</div>
		<h5 class="passenger-name serif">
			<?php echo $ticket->user()->name ?>
		</h5>

		<div class="flex-layout trip-departure">
			<div class="trip-date sans-serif">
				<div class="item-title sans-serif">date</div>
				<?php echo nicetime($ticket->date) ?>
			</div>

			<div class="trip-time sans-serif">
				<div class="item-title sans-serif">time</div>
				<?php echo $ticket->bus()->start_time(); ?>
			</div>
		</div>

		<div class="trip-price serif flex-layout center">
			<div class="item-title sans-serif">Price: </div>
			<?php echo number_format(23000) ?>
		</div>
	</div>
</div>