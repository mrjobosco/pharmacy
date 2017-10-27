<?php
include_once 'core/init.php';

if(isset($_FILES['photo'])){
	$allowed = array('jpg','jpeg','png');
		$file_name = ($_FILES['photo']['name']);
		$file_tmp = ($_FILES['photo']['tmp_name']);
		$file_ent = explode('.', $file_name);
		$file_extn = strtolower(end($file_ent));
		$file_size =  ($_FILES['photo']['size']);
		$reply = "";
		if (in_array($file_extn, $allowed) === true) 
		{
			if ($file_size > 2048000)
			 {
				$reply .= 'File is too big, File size must be less than 2 megabytes';
			}
				else
				{
					$size = getimagesize($file_tmp);
					$width = $size[0];
					$height = $size[1];

					if ($width >= 250 || $height >= 300)
					{

						$reply .= "Please the Dimensions must not exceed 250 by 300";
					}

					else
					{
						$file_path = change_picture($file_tmp, $file_extn);
						
						
						
						$reply .= '<img src ="'.$file_path.'"/>';
					}
				}
		}
		else 
		{
			$reply .= 'Please the only allowed file extensions are: '. implode(', ', $allowed);

		}
	 header("Content-Type: text/xml");
	 	$dom = new DOMDocument('1.0', 'UTF-8');
	 	$dom -> xmlStandAlone = true;

	 	$response = $dom -> createElement('response');
	 	$dom -> appendChild($response);

	 	$first = $dom -> createElement('first');
	 	$val = $dom -> createTextNode($reply);
	 	$first -> appendChild($val);

	 	$response -> appendChild($first);

	 	$xmlString = $dom -> saveXML();

	 	echo $xmlString;
	 	die();
	 }



?>