<?php
/**
* 
*/
class Orders
{
	private $_db, $_activeRecord, $_error;
	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_activeRecord = new ActiveRecord(self::tableName());
	}

	public static function tableName(){
		return 'orders';
	}

	public function activeRecord(){
		return $this->_activeRecord;
	}

	public function getOrders(){

		return $this->_activeRecord->hasMany(OrderDetails::tableName(), ['orderId'	=> $this->_activeRecord->getId()]);
	}

	public function getInvoice(){
		return $this->_activeRecord->hasMany(Invoice::tableName(), ['orderId'	=> $this->_activeRecord->getId()]);
	}

	public function getLastInvoice(){
	$all = 	 $this->_activeRecord->hasMany(Invoice::tableName(), ['orderId'	=> $this->_activeRecord->getId()]);
	$c = count($all);
	return $all[$c-1];	
	}	

}

?>