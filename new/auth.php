<?php

//headers
//header('Content-Type: application/json');

//Form Variables
$username = $_POST['username'];
$password = $_POST['password'];
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

$auth_result = array();

if (!$token_found)
{
	//$auth_result["isAuthenticated"] = false;
	$auth_result = array("AuthNJIT" => false);
	//header("location:index.php?error=inc1");
	echo json_encode($auth_result) . "<br />";
	// have you tried this?
	// for success?
	

}
else
{
	//$auth_result["isAuthenticated"] = true;
	$auth_result = array("AuthNJIT" => true);
	echo json_encode($auth_result) . "<br />";
	//header("location: loginSucc.html");
	

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

ini_set('display_errors',1); 
 error_reporting(E_ALL);
$result = sql_login($username,$password);
$result = json_decode($result);

if($result == "true"){
	//header("location: loginSucc.html");
	$local_auth_result = array("AuthLocal" => true);
	echo json_encode($local_auth_result) . "<br />";
	}
	else{
	//header("location:index.php?error=inc");
	$local_auth_result = array("AuthLocal" => false);
	echo json_encode($local_auth_result) . "<br />";
	}

?>
