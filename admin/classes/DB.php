<?php
class DB{
	private static $_instance = null;
	private 	$_pdo, 
				$_query, 
				$_error = false, 
				$_results, 
				$_count = 0;

	private function __construct(){

		try {
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
			
		}
		catch(PDOException $e){
			die($e->getMessage());

		}
	}

	public static function getInstance()
	{
		if (!isset(self::$_instance))
		{
			self::$_instance = new DB();
		}

		return self::$_instance;
	}

	public function custom($sql){
		if(!$this->query($sql)->error())
		{
			return $this;
		}
		return false;
		
	}
	public function limit($table, $first, $next){

		$sql = "SELECT * FROM {$table} LIMIT {$first}, {$next}";
			if(!$this->query($sql)->error())
			{
				return $this->_results;
			}
			return false;	
	}

	public function query($sql, $params = [])
	{
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
				$x = 1;
			if (count($params)){
				foreach($params as $param){

					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

				if($this->_query->execute()){
					$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
					$this->_count = $this->_query->rowCount();
				}
				else{
					$this->_error = true;
				}

				}
				return $this;

		}


		public function error(){
			return $this->_error;
		}

		public function read($table){
			$sql = "SELECT * FROM {$table}";
			if(!$this->query($sql)->error())
			{
				return $this->_results;
			}
			return false;
		}

		private function action($action, $table, $where = []){

			if (count($where) === 3)
			{
				$operators = ['=','>=','<=','<','>','!='];
				
					$field = $where[0];
					$operator = $where[1];
					$value = $where[2];


					if(in_array($operator, $operators)){
						$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

						if(!$this->query($sql, [$value])->error())
						{
							return $this;
						}

					}
			}

			return false;

		}

		private function actionOrder($action, $table, $where = [], $order){

			if (count($where) === 3)
			{
				$operators = ['=','>=','<=','<','>','!='];
				
					$field = $where[0];
					$operator = $where[1];
					$value = $where[2];


					if(in_array($operator, $operators)){
						$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ORDER BY {$order} ASC";

						if(!$this->query($sql, [$value])->error())
						{
							return $this;
						}

					}
			}

			return false;

		}



		private function actionCondition($action, $table, $where1 = [], $condition, $where2){

			if (count($where1) === 3)
			{
				$operators = ['=','>=','<=','<','>','!='];
				
					$field1 = $where1[0];
					$operator = $where1[1];
					$value1 = $where1[2];


					$field2 = $where2[0];
					$operator = $where2[1];
					$value2 = $where2[2];



					if(in_array($operator, $operators)){
						$sql = "{$action} FROM {$table} WHERE {$field1} {$operator} ? AND {$field2} {$operator} ? ORDER BY `id` DESC";

						if(!$this->query($sql, [$value1, $value2])->error())
						{
							return $this;
						}

					}
			}
		}


			private function actionConditionOr($action, $table, $where1 = [], $condition, $where2){

			if (count($where1) === 5)
			{
				$operators = ['=','>=','<=','<','>','!='];
				
					$field1 = $where1[0];
					$operator = $where1[1];
					$value1 = $where1[2];
					$or = $where1[3];
					$value11 = $where1[4];


					$field2 = $where2[0];
					$operator = $where2[1];
					$value2 = $where2[2];
					$or = $where2[3];
					$value21 = $where2[4];



					if(in_array($operator, $operators)){
						$sql = "{$action} FROM {$table} WHERE (({$field1} {$operator} ? {$or} ?) AND ({$field2} {$operator} ? {$or} ?))";

						if(!$this->query($sql, [$value1, $value11, $value2, $value21])->error())
						{
							return $this;
						}

					}
			}

			return false;

		}


		public function get($table, $where){
			return $this->action('SELECT *', $table, $where);
		}
		public function getCondition($table, $where1, $condition, $where2){
			return $this->actionCondition('SELECT *', $table, $where1, $condition, $where2);
		}

		public function getConditionOr($table, $where1, $condition, $where2){
			return $this->actionConditionOr('SELECT *', $table, $where1, $condition, $where2);
		}

		public function getOrder($table, $where, $order){
			return $this->actionOrder('SELECT *', $table, $where, $order);
		}

		public function delete($table, $where){
			return $this->action('DELETE', $table, $where);
		}

		public function results()
		{
			return $this->_results;
		}

		public function first(){
			if($this->results()){
				
			return $this->results()[0];
			}else {
				return false;
			}

		}

		public function insert($table, $fields=[]){
			if(count($fields))
			{
				$keys = array_keys($fields);
				$value = '';
				$x = 1;

				foreach($fields as $field)
				{
					$value .= '?';
					if($x < count($fields))
					{
						$value .=', ';
					}
					$x++;
				}


				$sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES({$value})";

				if(!$this->query($sql, $fields)->error())
					return true;
			}
			return false;

		}

		public function update($table, $id, $fields =[]){

			if(count($fields))
			{
				$set = '';
				$x = 1;

				foreach($fields as $name => $value)
				{
					$set .= "{$name} = ?";
					if($x < count($fields))
					{
						$set .= ', ';
					}
					$x++;
				}

				$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";				

				if(!$this->query($sql, $fields)->error())
				{
					return true; 
				}
			return false;
			}


		}


		public function counter(){
			return $this->_count;
		}


	}


?>