<?php
	/* 	Back end login script. Validates against SQL database
	sample username and password testname:testpass
	written by Samuel Roberts
	*/
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	session_start();
	$sql=mysqli_connect("sql.njit.edu","ser5","rTlzzhFwz","ser5");

	if(mysqli_connect_errno($sql))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$data = json_decode(file_get_contents('php://input'),true);
	$username = $data['username'];
	$password = $data['password'];
	//var_dump($data);
	$login=mysqli_query($sql, "SELECT * FROM USER WHERE UNAME='".$username."'");

	$data=mysqli_fetch_array($login);
	//var_dump($data);
	$password = md5($password);
	if($password != "" && $password===$data['PASSWD'])
	{
		$_SESSION['uname']=$username;
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}

?>
