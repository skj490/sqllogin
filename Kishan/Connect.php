<?php
//Code will send post data to middle-end

	
	$Username =$_POST['username'];
	$Password =$_POST['password'];
	
	$crl=curl_init();
	curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/cs490/login_system/auth.php");
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($crl, CURLOPT_POSTFIELDS, "username=$Username&password=$Password");
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
	
	$result= curl_exec($crl);
	//check result
	
	curl_close($crl);
	return $result;


?>
	
