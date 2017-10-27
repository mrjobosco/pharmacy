<?php
/**
* 
*/
class Product
{
	private $_db, $_activeRecord, $_error;
	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_activeRecord = new ActiveRecord(self::tableName());
	}

	public static function tableName(){
		return 'products';
	}

	public function activeRecord(){
		return $this->_activeRecord;
	}

	public function getDrugs($first, $next){
		return $this->_activeRecord->limit($first, $next);
	} 

	public function getDrugsCount(){
		return $this->_activeRecord->count();
	}
}

?>