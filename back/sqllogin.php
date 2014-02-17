/* 	Back end login script. Validates against SQL database
	sample username and password testname:testpass
	written by Samuel Roberts
*/
<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
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
		echo json_encode("true");
	}
	else
	{
		echo json_encode("false");
	}

?>
