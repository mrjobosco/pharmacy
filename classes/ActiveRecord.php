<?php

class ActiveRecord{
	private $_db, $_table, $_data;

	public function __construct($tableName){

		$this->_db = DB::getInstance();
		$this->_table = $tableName;
	}

	public function create($fields= [])
	{
		if(!$this->_db->insert($this->_table, $fields))
		{
			throw new Exception("Something went wrong, Please try again");
			
		}
	}

	public function read(){
		return $this->_db->read($this->_table);
	}

	public function limit($where, $first, $next){
		return $this->_db->limit($this->_table, $where, $first, $next);
	}

	public function find($user = null){
		if($user){
			$field = (is_numeric($user))? 'id' : 'username';
			$data = $this->_db->get($this->_table, [$field,'=',$user]);
			if($data->counter()){
			$this->_data = $data->first();
				
				return true;
			}
			else{
				return false;
			}

		}
	}

	public function getId()
		{
			return $this->_data->id;
		}

	public function getUsername()
		{
			return $this->_data->username;
		}

	public function update($fields){
		if(!$this->_db->update($this->_table, $this->getId(), $fields))
		{
			throw new Exception('There was a problem updating your record');
		}
	
	}

	public function data()
	{
		return $this->_data;
	}

	public function delete($where = []){
		$this->_db->delete($this->_table, $where);
	}

	public function tableName(){

		return $this->_table;
	}


	public function hasOne($table, $where){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($table, [$field, '=', $id])){
			return $data->first();
			
					}else{
			return false;
		}

		
	}

	public function hasMany($table, $where){
foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($table, [$field, '=', $id])){
			return $this->_db->results();
			
					}else{
			return false;
		}
		
	}

	public function hasManyCondition($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id1 = $value;
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id2 = $value;
		}

		if($data = $this->_db->getCondition($table, [$field1, '=', $id1], $condition, [$field2, '=', $id2])){
			return $this->_db->first();
			
					}else{
		

		
	}
}


	public function hasManyConditionOr($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id01 = $value[0];
			$operator = $value[1];
			$id02 = $value[2];
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id11 = $value[0];
			$operator1 = $value[1];
			$id12 = $value[2];
		}

		if($data = $this->_db->getConditionOr($table, [$field1, '=', $id01, $operator, $id02], $condition, [$field2, '=', $id11, $operator1, $id12]))
		{
			return $this->_db->results();
			
					}else{
		

		
	}
}




	public function hasManyOrder($table, $where, $order){
	foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->getOrder($table, [$field, '=', $id], $order)){
			return $this->_db->results();
			
					}else{
			return false;
		}
		
	}

	public function relation($where = []){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($this->_table, [$field, '=', $id])){
			return $data->first();
			
		}else{
			return false;
		}

		
	}

	public function relate($where = []){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($this->_table, [$field, '=', $id])){
			$this->_data = $data->first();
			return true;

		}else{
			return false;
		}

	}
		public function count(){
			$values = $this->read();
			return $this->_db->counter();
		}

		public function countWhere($where = []){
			$this->hasMany($this->_table, $where);
			return $this->_db->counter();
		}



}


?>