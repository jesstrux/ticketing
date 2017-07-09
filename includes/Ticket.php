<?php 
	require_once("model.php");
	require_once("Bus.php");
	require_once("User.php");
	require_once("Route.php");
	require_once("functions.php");
	
	/**
	* Ticket class
	*/
	class Ticket extends Model{
		protected static $table_name = "tickets";
  		protected static $db_fields = array('id', 'bus_id', 'user_id', 'seat_position', 'date');

		public $id;
		public $bus_id;
		public $user_id;
		public $seat_position;
		public $date;
		
		protected static function table_creating_query(){
			$query = "<br/>`id` int(11) NOT NULL auto_increment,";
			$query .= "<br/>`user_id` int(11) NOT NULL,";
			$query .= "<br/>`bus_id` int(11) NOT NULL,";
			$query .= "<br/>`seat_position` int(11) NOT NULL,";
			$query .= "<br/>`date` datetime NOT NULL ";
			$query .= "DEFAULT CURRENT_TIMESTAMP,";
			$query .= "<br/>PRIMARY KEY  (`id`),";
			$query .= "<br/>FOREIGN KEY(bus_id) REFERENCES buses(`id`) ON DELETE CASCADE,";
			$query .= "<br/>FOREIGN KEY(user_id) REFERENCES users(`id`) ON DELETE CASCADE";
			
			return $query;
		}

		public function bus(){
			$busClass = new Bus();
			return $busClass->find($this->bus_id);
		}

		public function route(){
			$routeClass = new Route();
			return $routeClass->find($this->bus()->route_id);
		}

		public function user(){
			$userClass = new User();
			return $userClass->find($this->user_id);
		}

		public function bus_str(){
			return $this->bus()->owner()->name;
		}

		public function passenger(){
			return $this->user()->name;
		}

		public function route_str(){
			$route = $this->route();
			return $route->point_one()->name . " to " . $route->point_two()->name;
		}

		public function date_str(){
			return nicetime($this->date);
		}

		public function time(){
			return $this->bus()->start_time();
		}

		public function price(){
			return number_format($this->bus()->price);
		}

		public function seat_number(){
			$row_names = range( 'a', 'z');
			$col_count = $this->bus()->seat_style == 0 ? 4 : 5;
			$row = $this->seat_position / $col_count;
			$col = ($this->seat_position % $col_count) + 1;

			return strtoupper($row_names[$row]).$col;
		}
	}
?>
