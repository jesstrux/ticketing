<?php 
	require_once("model.php");
	require_once("user.php");
	require_once("Route.php");
	
	/**
	* Bus class
	*/
	class Bus extends Model{
		protected static $table_name = "buses";
  		protected static $db_fields = array('id', 'name', 'owner_id', 'start_hour', 'start_min', 'type', 'route_id', 'price', 'seat_count', 'seat_style', 'direction');

		public $id;
		public $name;
		public $owner_id;
		public $start_hour;
		public $start_min;
		public $type;
		public $route_id;
		public $price;
		public $seat_count;
		public $seat_style; //2 by 3, 2 by 2
		public $direction;

		protected static function table_creating_query(){
			$query = "<br/>`id` int(11) NOT NULL auto_increment,";
			$query .= "<br/>`name` varchar(150) NOT NULL,";
			$query .= "<br/>`owner_id` int(11) NOT NULL,";
			$query .= "<br/>`start_hour` int(4) NOT NULL,";
			$query .= "<br/>`start_min` int(4) NOT NULL,";
			$query .= "<br/>`type` int(11) NOT NULL ";
			$query .= "DEFAULT 0,";
			$query .= "<br/>`route_id` int(11) NOT NULL,";
			$query .= "<br/>`price` int(11) NOT NULL,";
			$query .= "<br/>`seat_style` int(3) NOT NULL ";
			$query .= "DEFAULT 0,";
			$query .= "<br/>`seat_count` int(3) NOT NULL,";
			$query .= "<br/>`direction` int(3) NOT NULL ";
			$query .= "DEFAULT 0,";
			$query .= "<br/>PRIMARY KEY (`id`),";
			$query .= "<br/>FOREIGN KEY(owner_id) REFERENCES users(`id`),";
			$query .= "<br/>FOREIGN KEY(route_id) REFERENCES routes(`id`)";
			
			return $query;
		}

		public function owner(){
			$userClass = new User();
			return $userClass->find($this->owner_id);
		}

		public function route(){
			$routeClass = new Route();
			return $routeClass->find($this->route_id);
		}

		public function seats(){
			$seats = [];

			for ($i=0; $i < $this->seat_count; $i++) { 
				$seat = new stdClass();
				$seat->position = $i;
				$seat->number = $this->get_seat_number($i);
				$seats[] = $seat;
			}

			return $seats;
		}

		public function get_seat_number($seat_position){
			$row_names = range( 'a', 'z');
			$col_count = $this->seat_style == 0 ? 4 : 5;
			$row = $seat_position / $col_count;
			$col = ($seat_position % $col_count) + 1;

			return strtoupper($row_names[$row]).$col;
		}

		public function start_time(){
			$hr = $this->start_hour;
			$t_hr = $hr <= 12 ? $hr : $hr - 12;
			$am_pm = $hr < 12 ? "AM" : "PM";

			return  l_zero($t_hr) . ":" . l_zero($this->start_min) . $am_pm;
		}
	}
?>