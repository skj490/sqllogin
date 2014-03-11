<?php

	header("Content-Type: application/json");
	//$request = file_get_contents('php://input');

	ini_set('display_errors',1);
	error_reporting(E_ALL);

		$data = http_build_query(array("eno" => $_POST["eno"], "uno" => $_POST["uno"], "tscore" => $_POST["tscore"], "stime" => $_POST["stime"],
		"action" => "addUExam"));

		$crl=curl_init();
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request1.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($crl);
		curl_close($crl);

		$json = json_decode($res, true);
		
		
		
		
		if($json['result'] == "1"){
			
			header("Location: CreateEx.php");
		}
		else
		{
			echo "Error has occurred during insert, please try again";
		}
?>
