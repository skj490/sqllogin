<?php

	header("Content-Type: application/json");
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$data = http_build_query(array("sname" => $_POST["sname"], "qdesc" => $_POST["qdesc"], 
					"opt1" => $_POST["opt1"], "opt2" => $_POST["opt2"], 
					"opt3" => $_POST["opt3"], "opt4" => $_POST["opt4"], 
					"qtype" => $_POST["qtype"], "qworth" => $_POST["qworth"], 
					"answer" => $_POST["answer"], "notes" => $_POST["notes"],
					"action" => "addQues2"));
	
	
		//$data_string = json_encode($data);
		$crl=curl_init();
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data /*_string*/ );
		//curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($crl);
		curl_close($crl);

		$json = json_decode($res,true);
		//print_r($json);
		
		
		
		
		if($json['result'] == "1"){
			
			header("Location: CreateEx.php");
		}
		else
		{
			echo "Error has occurred during insert, please try again";
		}
?>
