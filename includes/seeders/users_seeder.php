<?php
	require_once '../User.php';
	require_once '../../vendor/autoload.php';

	$faker = Faker\Factory::create();
	
	$user = new User();

	$user::migrate_down();
	return $user::migrate_up();


	for ($i=0; $i < 15; $i++) {
		$user_array = array();
		$user_array["name"] = $faker->name();
		$user_array["email"] = $faker->freeEmail();
		$user_array["password"] = $faker->password();
		
		$user_obj = $user::from_array($user_array);
		$id = $user_obj->create();

		print_r($id);
		echo "<br>";
	}
?>