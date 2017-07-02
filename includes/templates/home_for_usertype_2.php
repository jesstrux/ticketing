<?php
	$summary = [
		["group" => "Users","count" => 23, "link" => "users.php"],
		["group" => "Buses","count" => 123, "link" => "buses.php"],
		["group" => "Tickets sold","count" => 476, "link" => "tickets.php"],
		["group" => "Routes","count" => 89, "link" => "routes.php"],
		["group" => "End points","count" => 21, "link" => "points.php"]
	];
?>
<div>
	<h2 class="serif" style="line-height:1em; font-size: 2em">Site summary,</h2>
	<p class="sans-serif" style="font-size: 1.2em; font-weight: normal;">
		Here is some summarized information about the site. <br>
	</p>
	<div class="flex-layout wrap">
		<?php
			foreach ($summary as $key => $item) {
				echo '
					<div class="summary-card">
						<div class="card-content">
							<span class="card-count serif">'.$item['count'].'</span>
							<span class="card-title sans-serif">'.$item['group'].'</span>
						</div>
						<a href="'.$item['link'].'" class="card-link serif">view all</a>
					</div>
				';
			}
		?>
	</div>
</div>