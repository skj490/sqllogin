<?php
	//session_start();
	//header("Content-Type: application/json");
	header("Content-Type: text/html");
	$request = file_get_contents('php://input');

	ini_set('display_errors',1);
	error_reporting(E_ALL);

		$data = array("action" => "listQues2");

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
			
		foreach($json as $key=>$value){
			print("&nbsp;");
		    if($key != "result" && $key != "message" && $key !="data"){
				if($value["QTYPE"] == "1"){
		        
				//print("<tr><td></td><td></td></tr>");
				print("<tr>
		        <td><input type='checkbox' name='qno' value='".$value["QNO"]."'/></td>
		        
		        <td>".$value["QNO"]." </td>  <td> ".$value["QDESC"]."</tr></td>");
		    }
			if($value["QTYPE"] == "2"){
				
				print("<tr>
		        <td><input type='checkbox' name='qno' value='".$value["QNO"]."'/></td>
		        
		        <td>".$value["QNO"]." </td><td> ".$value["QDESC"]."</tr></td>");
			}
			if($value["QTYPE"] == "3"){
				print("<tr>
		        <td><input type='checkbox' name='qno' value='".$value["QNO"]."'/></td>
		        
		        <td>".$value["QNO"]." </td><td> ".$value["QDESC"]."</tr></td>");
			}
			if($value["QTYPE"] == "4"){
				print("<tr>
		        <td><input type='checkbox' name='qno' value='".$value["QNO"]."'/></td>
		        
		        <td>".$value["QNO"]." </td><td> ".$value["QDESC"]."</tr></td>");
			}
				
			}
		}
		
		
?>
