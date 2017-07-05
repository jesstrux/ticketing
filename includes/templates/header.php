<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BBPT | <?php echo $page ?></title>
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
	<div id="container">
		<aside>
			<div class="long-header">
				BBPT
			</div>
			<ul>
				<?php 
					if(!isset($user) || !$user){
						$session->logout();
						header("Location: login.php");
					}

					if(!isset($page))
						$page = "search";

					$admin_only = $user->role != 2 ? "display: none" : "";
					$owners_only = $user->role != 1 ? "display: none" : "";
					$user_only = $user->role != 0 ? "display: none" : "";
					$no_users = $user->role == 0 ? "display: none" : "";
				?>

				<li class="<?php echo $page == 'home' ? 'active' : ''; ?>">
					<a href="index.php">Home</a>
				</li>

				<li class="<?php echo $page == 'buses' ? 'active' : ''; ?>">
					<a href="buses.php">Buses</a>
				</li>

				<li style="<?php echo $owners_only ?>" class="<?php echo $page == 'user_buses' ? 'active' : ''; ?>">
					<a href="user_buses.php?owner=<?php echo $user->id; ?>">
						My Buses</a>
				</li>

				<li style="<?php echo $user_only ?>" class="<?php echo $page == 'trips' ? 'active' : ''; ?>">
					<a href="trips.php">My Trips</a>
				</li>

				<li style="<?php echo $admin_only ?>" class="<?php echo $page == 'users' ? 'active' : ''; ?>">
					<a href="users.php">Users</a>
				</li>

				<li style="<?php echo $admin_only ?>" class="<?php echo $page == 'tickets' ? 'active' : ''; ?>">
					<a href="tickets.php">Tickets</a>
				</li>

				<li style="<?php echo $admin_only ?>" class="<?php echo $page == 'routes' ? 'active' : ''; ?>">
					<a href="routes.php">Routes</a>
				</li>
			</ul>
		</aside>
		<main>
			<header id="mainNav">
				<?php
					if(isset($prevpage) && strlen($prevpage) > 0){
						echo '<a href="'.$prevpage.'" style="margin-right: 20px; line-height: 20px; text-decoration: none;">
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 20 20"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
						</a>';
					}
				?>
				<span id="pageTitle">
					<?php echo isset($page_title) ? $page_title : $page ?>
				</span>

				<div id="navBarStuff" style="margin-left: 20px;">
					<?php echo isset($navBarContent) ? $navBarContent : "" ?>
				</div>

				<form id="searchForm" action="search.php" method="GET">
					
				</form>

				<div id="userMenu">
					<div class="flex-layout center-center">
						<span id="username" style="margin-right:20px">
							<?php
								echo $user->name;
							?>
						</span>
						<span id="dp" style="display:inline-block;width:50px;height:50px">
							<img src="assets/images/profile_pictures/<?php echo $user->user_photo ?>" alt="">
						</span>
					</div>

					<div id="details">
						<span>
							<?php
								echo $user->name;
							?>
						</span>
						<br>
						<a href="logout.php" class="rounded-btn">
							LOGOUT
						</a>
					</div>
				</div>
			</header>
			<div id="mainContent">