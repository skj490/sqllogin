<?php

function sql_login($user, $pass){
	$ch = curl_init();	
	//URL for Authentication by Sam in Back end	
	curl_setopt($ch, CURLOPT_URL, "http://afsaccess1.njit.edu/~ser5/sqllogin.php"); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
	 	"uname" => $user,
	 	"passwd" => $pass,
	)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

ini_set('display_errors',1); 
 error_reporting(E_ALL);
$result = sql_login($_POST["uname"],$_POST["passwd"]);
$result = json_decode($result);

if($result == "true"){
	header("location: loginSucc.html");
	}
	else{
	header("location:index.php?error=inc");
	}
	
	/* Updated by Kishan 2/16/14 This php script will be used to connect to back end */
	
?>	
	

