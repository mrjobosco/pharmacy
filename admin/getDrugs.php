<?php
include_once 'core/init.php';
	
	$id = Input::get('id');

	if($id == 1)
	{
		$start = 0;
	}else{
		$start = ($id - 1) * 5;
	}


   $drugs = new Product();
   $allDrugs = $drugs->getDrugs($start, 5);
   
   $count = $drugs->getDrugsCount();
   $pages = ceil($count/5);

   $name		 = [];
   $tags		 = [];
   $price		 = [];
   $qty			 = [];
   $image		 = [];
   $ids			 = [];


  foreach ($allDrugs as $drug) {
	$name[]		= $drug->name;
	$tags[]		= $drug->tags;
	$price[] 	= $drug->price;
	$qty[]		= $drug->qty;
	$image[]	= $drug->image;
	$ids[]		= $drug->id;


  }


header("Content-Type: text/xml");

$dom = new DOMDocument('1.0','UTF-8');

$dom-> xmlStandAlone = true;


$response = $dom->createElement('response');
$dom->appendChild($response);

$j = 0;
 foreach ($allDrugs as $key) {
 	$comment = $dom->createElement("child");
 	$n	 	= $dom->createElement("name");
 	$i		= $dom->createElement('image');
 	$t 		= $dom->createElement('tags');
 	$p		= $dom->createElement('price');
 	$q 		= $dom->createElement('qty');
 	$ii 	= $dom->createElement('id');

 	$val1 = $dom->createTextNode($name[$j]);
 	$val2 = $dom->createTextNode($image[$j]);
 	$val3 = $dom->createTextNode($tags[$j]);
 	$val4 = $dom->createTextNode($price[$j]);
 	$val5 = $dom->createTextNode($qty[$j]);
 	$val6 = $dom->createTextNode($ids[$j]);


 	$n->appendChild($val1);
 	$i->appendChild($val2);
 	$t->appendChild($val3);
 	$p->appendChild($val4);
 	$q->appendChild($val5);
 	$ii->appendChild($val6);


 	$comment->appendChild($n);
 	$comment->appendChild($i);
 	$comment->appendChild($t);
 	$comment->appendChild($p);
 	$comment->appendChild($q);
 	$comment->appendChild($ii);

 	$response->appendChild($comment);
 	$j++;

 }
 $xmlString = $dom-> saveXML();

echo $xmlString;


?>