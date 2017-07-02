<?php
	require_once 'includes/User.php';
	require_once 'includes/Point.php';
	require_once 'includes/Route.php';
	require_once 'includes/Bus.php';
	require_once 'includes/Ticket.php';
	require_once 'vendor/autoload.php';

	$faker = Faker\Factory::create();
	$userClass = new User();

	//seed users
	for ($i=0; $i < 20; $i++) {
		$owners = $userClass::get("role", 1);
		$user_role = $faker->numberBetween(0,2); 
		$user = new User();
		$fname = $user_role == 1 ? $faker->company() : $faker->firstName();
		$user->name = $user_role == 1 ? $fname : $fname . " " . $faker->lastName();
		$user->username = strtolower(str_replace(" ", "_", $fname));
		$user->password = md5("1234");
		$user->role = $user_role;
		$user->user_photo = $user_role == 1 ? "buses/bus".count($owners).".jpg" : "default_dp.png";

		$user->save();

		echo "New user!<br>";
	}

	echo "<br><br>";

	//seed points
	for ($i=0; $i < 20; $i++) { 
		$point = new Point();
		$name = $faker->city();
		$point->name = $name;
		$point->code = substr(strtoupper($name), 0, 3);
		$point->save();

		echo "New point!<br>";
	}

	echo "<br><br>";

	//seed routes
	for ($i=0; $i < 20; $i++) { 
		$route = new Route();
		$route->point_one_id = $faker->numberBetween(1, 20);
		$route->point_two_id = $faker->numberBetween(1, 20);
		$route->save();

		echo "New route!<br>";
	}

	echo "<br><br>";

	//seed buses
	$userClass = new User();
	$routeClass = new Route();
	$busClass = new Bus();

	$users = $userClass::get("role", 1, "id");
	$routes = $routeClass::all();

	for ($i=0; $i < 20; $i++) {
		$mins = ["00", "15", "30"];

		$userClass = new User();
		$routeClass = new Route();

		$seat_style = $faker->numberBetween(0, 1);
		$five_seaters = [75, 80, 85,  90];
		$four_seaters = [60, 64, 68,  72];
		$seat_count = $seat_style == 0 ? $five_seaters[array_rand($five_seaters)] : $four_seaters[array_rand($four_seaters)];

		$bus = new Bus();
		$bus->owner_id = $users[array_rand($users)]->id;
		$bus->route_id = $routes[array_rand($routes)]->id;
		$bus->start_hour = $faker->numberBetween(6, 18);
		$bus->start_min = $mins[array_rand($mins)];
		$bus->type = $faker->numberBetween(0, 2);
		$bus->price = $faker->numberBetween(12000, 30000);
		$bus->seat_style = $seat_style;
		$bus->seat_count = $seat_count;
		$bus->direction = $faker->numberBetween(0, 1);
		$bus->save();

		echo "New bus!<br>";
	}

	$busClass = new Bus();
	$buses = $busClass::all();
	$users = $userClass::all();

	echo "<br><br>";
	//seed tickets
	for ($i=0; $i < 20; $i++) { 
		$bus_ran = array_rand($buses);
		$ticket = new Ticket();
		$ticket->bus_id = $buses[$bus_ran]->id;
		$ticket->user_id = $users[array_rand($users)]->id;
		$ticket->seat_position = $faker->numberBetween(0, $buses[$bus_ran]->seat_count);

		$fake_date = json_encode($faker->dateTimeThisYear());
		$real_date = json_decode($fake_date);
		$ticket->date = $real_date->date;
		$ticket->save();

		echo "New ticket!<br>";
	}
?>