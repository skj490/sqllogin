<?php

	//header("Content-Type: application/json");
	header("Content-Type: text/html");

	ini_set('display_errors',1);
	error_reporting(E_ALL);

		$data = array("action" => "listUExam");

		
		$crl=curl_init();
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request1.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data/*_string*/ );
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($crl);
		curl_close($crl);

		$json = json_decode($res,true);
		//print_r($json);
		
		foreach($json as $key=>$value){
			print("&nbsp;");
		    if($key != "result" && $key != "message" && $key !="data"){
				if($value['UNO'] == "1"){		        
				
				print("<tr>
		        <td><input type='radio' name='eno' value='".$value["ENO"]."'/></td>
		        
		        <td> Quiz - ".$value["ENO"]." </td>  <td> &nbsp; Due Date - ".$value["STIME"]."</tr></td>");
		    	}
			}
		}
		
?>
