<?php
//Code will send post data to middle-end

ini_set('display_errors',1); 
 error_reporting(E_ALL);
	$Username =$_POST['username'];
	$Password =$_POST['password'];
	$data = array("username" => $Username, "password" => $Password);                                                                    
	$data_string = json_encode($data);  
	$crl=curl_init();
	curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/cs490/login_system/auth.php");
	//curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $data_string );
	curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($crl);
	//check result
	
	curl_close($crl);
	$result = json_decode($result, true);
	if ( $result["authNJIT"] && $result["AuthLocal"] )
	{
		header("location: loginUnSucc.html");
	}
	else if ( $result["authNJIT"] )
	{
		header("location: ucidSucc.html");
	}
	else 
	{
		header("location: sqlSucc.html");
	}
?>
