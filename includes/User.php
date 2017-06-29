<?php 
	require_once("model.php");
	require_once("Bus.php");

	/**
	* User class
	*/
	class User extends Model{
		protected static $table_name = "users";
  		protected static $db_fields = array('id', 'name', 'username', 'password', 'role', 'user_photo');

		public $id;
		public $name;
		public $username;
		public $password;
		public $role;
		public $user_photo;

		protected static function table_creating_query(){
			$query = "<br/>`id` int(11) NOT NULL auto_increment,";
			$query .= "<br/>`name` varchar(50) NOT NULL,";
			$query .= "<br/>`username` varchar(50) NOT NULL,";
			$query .= "<br/>`password` varchar(50) NOT NULL,";
			$query .= "<br/>`role` varchar(50) NOT NULL,";
			$query .= "<br/>`user_photo` varchar(100) NOT NULL ";
			$query .= "DEFAULT 'default_dp.png',";
			$query .= "<br/>PRIMARY KEY (`id`)";	
			return $query;
		}

		public function buses(){
			$busClass = new Bus();
			return $busClass->get_where("owner_id=".$this->bus_id);
		}
	}
?>