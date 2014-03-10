<?php

	header("Content-Type: application/json");

	//COMMENT OR UNCOMMENT THESE LINES IF YOU WANT TO SEE ERROR MESSAGES TO HELP WITH DEBUGGING
	ini_set('display_errors',1);
	error_reporting(E_ALL);

		//UNNCOMENT AND PUT THE ACTION HERE IE listQues or listUser
		//$action = "listEUAns";

		//PUT THE VARIABLES TO PASS HERE IE ENO UNO UNAME PASSWORD ETC
		//THIS QUERY WILL LIST THE ENTIRE EXAM #1 FOR USER #1 WITH HIS ANSWERS 
		//$data = http_build_query(array(
					//"eno" => "1",
					//"uno" => "1",
					//'action' => $action
					//));
		

		//EXAMPLE QUERY
		//THIS QUERY WILL LIST ALL THE QUESTIONS
		$data = array("action" => "listQues");

		$data_string = json_encode($data);
		$crl=curl_init();
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data /*_string*/ );
		//curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($crl);
		curl_close($crl);

		$json = json_decode($res,true);
		

		//JSON VRIABLE HOLDS AN ARRAY OF ALL THE VALUES FOR YOU TO WORK WITH SO YOU DO A 
		//FOREACH LOOP TO ACCESS THE INFORMATION AND DISPLAY IT ACCORDINGLY
		//print_r($json); 
			for($i = 0; $i < count($json); $i++){
			$Quest = $json[$i]['QNO'];
			//$QNam = $json[$i]['SNAME'];
			
			echo $Quest;
			//$i++;
		}
?>
