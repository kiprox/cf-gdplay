<?php 

error_reporting(0);
include_once 'library.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if (isset($_POST['link'])) {
		
		$link = (!empty($_POST['link'])) ? $_POST['link'] : '';
		$poster = (!empty($_POST['poster'])) ? $_POST['poster'] : '';
		$label = (!empty($_POST['label'])) ? $_POST['label'] : '';
		
		$var = array();
		$var['link'] = trim($link);
		$var['poster'] = trim($poster);

		$varSub = array();
	
		$sub = $_POST['sub'];
		foreach ($sub as $key => $value) {
			if ($value != '') {
				$varSub[$label[$key]] = trim($value);
			}
			else $varSub['Default'] = "";
		}
		$var['sub'] = $varSub;
		
		echo encode(json_encode($var));

	} else echo 'Error Isset!';
} else echo 'Error Request!';

?>