<?php

	header("Content-Type: application/json");

	ini_set('display_errors',1);
	error_reporting(E_ALL);

		$data = http_build_query(array("eno" => $_POST["eno"], "qno" => $_POST["qno"], "action" => "addEQues"));

		$crl=curl_init();
		//curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~krp56/Test/request.php");
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request1.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data /*_string*/ );
		//curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($crl);
		curl_close($crl);

		$json = json_decode($res, true);
		
		print_r($json);
		
		
		if($json['result'] == "1"){
			
			header("Location: CreateEx.php");
		}
		else
		{
			echo "Error has occurred during insert, please try again";
			
		}
?>
