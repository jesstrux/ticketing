<?php 
	require_once("model.php");
	require_once("Point.php");
	require_once("Bus.php");
	
	/**
	* Route class
	*/
	class Route extends Model{
		protected static $table_name = "routes";
  		protected static $db_fields = array('id', 'point_one_id', 'point_two_id');

		public $id;
		public $point_one_id;
		public $point_two_id;
		
		protected static function table_creating_query(){
			$query = "<br/>`id` int(11) NOT NULL auto_increment,";
			$query .= "<br/>`point_one_id` int(11) NOT NULL,";
			$query .= "<br/>`point_two_id` int(11) NOT NULL,";
			$query .= "<br/>PRIMARY KEY  (`id`),";
			$query .= "<br/>FOREIGN KEY(point_one_id) REFERENCES points(`id`) ON DELETE CASCADE,";
			$query .= "<br/>FOREIGN KEY(point_two_id) REFERENCES points(`id`) ON DELETE CASCADE";
			
			return $query;
		}

		public function point_one(){
			$pointClass = new Point();
			return $pointClass->find($this->point_one_id);
		}

		public function point_two(){
			$pointClass = new Point();
			return $pointClass->find($this->point_two_id);
		}

		public function buses(){
			$busClass = new Bus();
			return $busClass->get_where("route_id = $this->id");
		}
	}
?>
