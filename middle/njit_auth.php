<?php

//headers
header('Content-Type: application/json');

//Form Variables
$username = $_POST['username'];
$password = $_POST['password'];
$uu_id = "0xACA021";
$url = "https://cp4.njit.edu/cp/home/login";
$postdata = "user=".$username."pass=".$password."uuid=".$uu_id; 
$cookie="cookie.txt"; 

$ch = curl_init(); 
curl_setopt ($ch, CURLOPT_URL, $url); 
curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie); 
curl_setopt ($ch, CURLOPT_REFERER, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query(array(
"user" => $username,
"pass" => $password,
"uuid" => "0xACA021"
))); 
curl_setopt ($ch, CURLOPT_POST, 1); 
$result = curl_exec ($ch); 

//echo $result;

$pos = strpos($result, "loginok.html");

//$auth_result = array();
if ($pos === false)
{
	//$auth_result["isAuthenticated"] = false;
	$auth_result = array("isAuthenticated" => false);
	echo json_encode($auth_result);
}
else
{
	//$auth_result["isAuthenticated"] = true;
	$auth_result = array("isAuthenticated" => true);
	echo json_encode($auth_result);
}


curl_close($ch);

?>
