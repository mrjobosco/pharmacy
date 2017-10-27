<?php
/**
* 
*/
class OrderDetails
{
	private $_db, $_activeRecord, $_error;
	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_activeRecord = new ActiveRecord(self::tableName());
	}

	public static function tableName(){
		return 'order_details';
	}

	public function activeRecord(){
		return $this->_activeRecord;
	}

}

?>