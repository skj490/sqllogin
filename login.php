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

if($result == "true"){ //This can be updated if needed, but just checks the output of sqllogin.php which is true if password is correct
	header("location: loginSucc.html"); //Switch to display login successful 
	}
	else{
	echo 'Incorrect UCID or Password'; // Send back message to jscript and display on same screen
	}
	
	
	
	
	
	

/*if ( $UCID == '1' )
{
	echo "Valid UCID login<br>";
}
else
{
	echo "Invalid UCID login<br>";
}

session_start();
$sql=mysqli_connect("sql.njit.edu","ser5","rTlzzhFwz","ser5");

if(mysqli_connect_errno($sql))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$login=mysqli_query($sql, "SELECT * FROM USER WHERE UNAME='".$_POST["uname"]."'");

$data=mysqli_fetch_array($login);
$password=$_POST["passwd"];
$password = md5($password);
if($_POST["passwd"] != "" && $password===$data['PASSWD'])
{
	$_SESSION['uname']=$_POST["uname"];
	echo "Valid SQL login<br>";
	//header("Location: http://web.njit.edu/~rjc55/home.php");
}
else
{
	echo "Wrong SQL Database Password<br>";
	//header("Location: http://web.njit.edu/~rjc55/login.html");
}*/	
?>
