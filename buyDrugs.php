<?php
include_once 'core/init.php';
	
	$id =	Input::get('id');
	$qty =	Input::get('qty');
	$drug  = new Product();
	$u = new User();

	$qty = (int)$qty;

	$drug->activeRecord()->relate(['id' => $id]);

$price = $drug->activeRecord()->data()->price;
$avail = $drug->activeRecord()->data()->qty;

if($qty <= $avail){

$price = (double)$price;

$amount = $price * $qty;

$order = new Orders();
	$order->activeRecord()->relate(['userId' => $u->activeRecord()->getId()]);
$orderDetails = new OrderDetails();

	try{
		$orderDetails->activeRecord()->create([
			'orderId'	=> $order->activeRecord()->getId(),
			'productId'	=> $id,
			'qty'		=> $qty,
			'price'		=> $amount,
            'paid'      =>  0

			]);
		$c_qty = $order->activeRecord()->data()->qty + $qty;

		$c_amount = $order->activeRecord()->data()->amount + $amount;
		try{
			
		$order->activeRecord()->update([
			'amount' => ($c_amount),
			'qty'	=>	($c_qty)
			]);
		}
		catch(Exception $e){
			die($e->getMessage());
		}


	}catch(Exception $e){
		die($e->getMessage());


	}


header("Content-Type: text/xml");

$dom = new DOMDocument('1.0','UTF-8');

$dom-> xmlStandAlone = true;

	$response = $dom->createElement('response');
	$dom->appendChild($response);

	$total = $dom->createElement('child');
	
	$drugs = $dom->createElement('drugs');
	$amount = $dom->createElement('amount');
	
	$val1 = $dom->createTextNode($c_qty);
	$val2 = $dom->createTextNode($c_amount);

	$drugs->appendChild($val1);
	$amount->appendChild($val2);

	$total->appendChild($drugs);
	$total->appendChild($amount);

	$response->appendChild($total);

$xmlString = $dom-> saveXML();

echo $xmlString;
}else{

header("Content-Type: text/xml");

$dom = new DOMDocument('1.0','UTF-8');

$dom-> xmlStandAlone = true;

	$response = $dom->createElement('response');
	$dom->appendChild($response);

	$total = $dom->createElement('child');
	
	$drugs = $dom->createElement('drugs');

	
	$val1 = $dom->createTextNode(0);


	$drugs->appendChild($val1);


	$total->appendChild($drugs);


	$response->appendChild($total);

$xmlString = $dom-> saveXML();

echo $xmlString;
}

?>