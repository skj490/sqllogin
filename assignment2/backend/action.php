<?php
//Code will send post data to middle-end

ini_set('display_errors',1); 
 error_reporting(E_ALL);
	switch ($_POST['action'])
	{	
		case "login":
			$password = md5($_POST["password"]);
			$data = array("username" => $_POST["username"], "password" => $password, "action" => "login");
			$send = true;
			break;
		
		case "addUser":
			$password = md5($_POST["password"]);
			$data = array("username" => $_POST["username"], "password" => $password, "displayn" => $_POST["displayn"], "ulevel" => $_POST["ulevel"], "action" => "addUser");
			$send = true;
			break;
		
		case "delUser":
			$data = array("usernum" => $_POST["usernum"], "action" => "delUser");
			$send = true;
			break;
		
		case "listUser":
			$data = array( "action" => "listUser" );
			$send = true;
			break;
		
		case "addQues":
			$data = array("sname" => $_POST["sname"], "qdesc" => $_POST["qdesc"], "qtype" => $_POST["qtype"], "qworth" => $_POST["qworth"], 
					"answer" => $_POST["answer"], "notes" => $_POST["notes"],
					"action" => "addQues");
			$send = true;
			break;
		
		case "delQues":
			$data = array("quesnum" => $_POST["quesnum"], "action" => "delQues");
			$send = true;
			break;
		
		case "listQues":
			$data = array( "action" => "listQues" );
			$send = true;
			break;	
			
		case "addExam":
			$data = array("ename" => $_POST["ename"], "eduration" => $_POST["eduration"], "cdatetime" => $_POST["cdatetime"], "mpscore" => $_POST["mpscore"], 
					"action" => "addExam");
			$send = true;
			break;
		
		case "delExam":
			$data = array("examnum" => $_POST["examnum"], "action" => "delExam");
			$send = true;
			break;
		
		case "listExam":
			$data = array( "action" => "listExam" );
			$send = true;
			break;	
		
		case "addEQues":
			$data = array("eno" => $_POST["eno"], "qno" => $_POST["qno"], "action" => "addEQues");
			$send = true;
			break;
		
		case "delEQues":
			$data = array("eno" => $_POST["eno"], "eline" => $_POST["eline"], "action" => "delEQues");
			$send = true;
			break;
		
		case "listEQues":
			$data = array( "action" => "listEQues" );
			$send = true;
			break;	
		
		case "addUExam":
			$data = array("eno" => $_POST["eno"], "uno" => $_POST["uno"], "tscore" => $_POST["tscore"], "stime" => $_POST["stime"],
					"action" => "addUExam");
			$send = true;
			break;
		
		case "delUExam":
			$data = array("eno" => $_POST["eno"], "uno" => $_POST["uno"], "action" => "delUExam");
			$send = true;
			break;
		
		case "listUExam":
			$data = array( "action" => "listUExam" );
			$send = true;
			break;
		
		case "addUEAns":
			$data = array("eno" => $_POST["eno"], "uno" => $_POST["uno"], "eline" => $_POST["eline"], "uans" => $_POST["uans"],
					"action" => "addUEAns");
			$send = true;
			break;
		
		case "delUEAns":
			$data = array("eno" => $_POST["eno"], "uno" => $_POST["uno"], "eline" => $_POST["eline"], "action" => "delUEAns");
			$send = true;
			break;
		
		case "listUEAns":
			$data = array( "action" => "listUEAns" );
			$send = true;
			break;

	}
	//var_dump$($_POST[action]);
	var_dump($data);
	//echo "$_POST[action])<br>";
	//$send = false;
	if ($send)
	{
		echo "test <br>";                                                               
		$data_string = json_encode($data);  
		$crl=curl_init();
		//curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/cs490/login_system/auth.php");
		curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~ser5/sqlaction.php");
		//curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data_string );
		curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($crl);
		
		curl_close($crl);
		$result = json_decode($result, true);
		
		echo "$result[message]<br>";
		
		if ($result["data"] == "Query Output" )
		{	
			foreach($result as $key => $val)
			{
				echo "$key | ";
				if ( $key !== 'result' && $key !== 'message' && $key !== 'data')
				{						
					foreach($val as $key2 => $val2)
					{
						echo "$key2 $val2 |";
					}
				}
				else
				{
					echo "$val <br>";
					continue;
				}
				echo "<br>";
			}
		}
		
	}
?>
