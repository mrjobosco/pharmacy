<?php
include_once 'core/init.php';
if (Input::exists()) {

	$id = Input::get('id');
	$value = Input::get('value');

	$product = new Product();

	$product->activeRecord()->relate(['id'=> $id]);
	try{
	$product->activeRecord()->update([
		'qty' => $value,
	]);

		echo 'Done';

	}
	catch(Exception $e){
		die($e->getMessage());
	}

}
?>