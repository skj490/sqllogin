<?php

//headers
//header('Content-Type: application/json');

//Form Variables

ini_set('display_errors',1); 
 error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'),true);
$username = $data['username'];
$password = $data['password'];
//$username = $_POST['username'];
//$password = $_POST['password'];

$uu_id = "0xACA021";
$url = "https://cp4.njit.edu/cp/home/login";
//$postdata = "user=".$username."pass=".$password."uuid=".$uu_id;
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
$res = curl_exec ($ch);

curl_close($ch);
//echo $result;

$token_found = strpos($res, "welcome");

$auth_result = array( "authNJIT" => "false", "AuthLocal" => "false");

if (!$token_found)
{
	$auth_result["authNJIT"] = false;
}
else
{
	$auth_result["authNJIT"] = true;
}

//LOCAL AUTHENTICATION
$local_auth_result = array();
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


$result = sql_login($username,$password);
$result = json_decode($result);

if($result == "true"){
	//header("location: loginSucc.html");
	$auth_result["AuthLocal"] = true;
	echo json_encode($auth_result);
	}
	else{
	//header("location:index.php?error=inc");
	$auth_result["AuthLocal"] = false;
	echo json_encode($auth_result);
	}

?>
