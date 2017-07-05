<?php 
	require_once("model.php");
	
	/**
	* Point class
	*/
	class Point extends Model{
		protected static $table_name = "points";
  		protected static $db_fields = array('id', 'name', 'code');

		public $id;
		public $name;
		public $code;
		
		protected static function table_creating_query(){
			$query = "<br/>`id` int(11) NOT NULL auto_increment,";
			$query .= "<br/>`name` varchar(150) NOT NULL,";
			$query .= "<br/>`code` varchar(10) NOT NULL,";
			$query .= "<br/>PRIMARY KEY  (`id`)";
			
			return $query;
		}
	}
?>