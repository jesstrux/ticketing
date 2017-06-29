<?php
	require_once '../Category.php';
	require_once '../../vendor/autoload.php';

	$faker = Faker\Factory::create();
	
	$category = new Category();

	// $category::migrate_down();
	// return $category::migrate_up();


	for ($i=0; $i < 5; $i++) { 
		$category_array = array();
		$category_array["name"] = $faker->realText(rand(10,20));
		
		$category_obj = $category::from_array($category_array);
		$id = $category_obj->create();

		print_r($id);
		echo "<br>";
	}
?>