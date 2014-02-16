<?php
//Code will send data to Njit_Auth.php for user authentication

	
	$Username =$_POST['username'];
	$Password =$_POST['password'];
	
	$crl=curl_init();
	curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~krp56/njit_auth.php");
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($crl, CURLOPT_POSTFIELDS, "username=$Username&password=$Password");
	curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
	
	$result= curl_exec($crl);
	//check result
	
	curl_close($crl);
	return $result;
	
	/* $result = json_decode($result);
	
	if($result == "true"){
	header("location: loginSucc.html");
	}
	else{
	header("location:index.php?error=inc1");
	} */
 /* Edited by Kishan Patel 2/16/14, this script will be used to connect/send data to middle end*/

?>
