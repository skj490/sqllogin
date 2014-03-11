<?php
	/* 	Back end database scripts. 
	Validates against SQL database sample username and password testname:testpass
	Various scripts to insert/delete and query the database tables.
	written by Samuel Roberts
	*/
	$data = json_decode(file_get_contents('php://input'),true);
	
	session_start();
	
	$sql=mysqli_connect("sql.njit.edu","ser5","rTlzzhFwz","ser5");
	
	$result = array("result" => false, "message" => "", "data" => "");
	
	if(mysqli_connect_errno($sql))
	{
		$result["result"] = false;
		$result["message"] = "Failed to connect to MySQL: " . mysqli_connect_error();
		echo json_encode($result);
	}
	else
	{
		mysqli_select_db($sql, "ser5");
		switch ($data["action"]){
			
			case "login":
				$check=mysqli_query($sql, "SELECT * FROM USER WHERE USERNAME='".$data["username"]."'");
				$record=mysqli_fetch_array($check);
				//echo "$check <br>";
				if ($check && $data["password"] != "" && $data["password"]===$record['PASSWORD'])
				{
					$result["result"] = true;
					$result["uno"] = $record['UNO'];
					$result["username"] = $record['USERNAME'];
					$result["password"] = $record['PASSWORD'];
					$result["display"] = $record['DISPLAY'];
					$result["ulevel"] = $record['ULEVEL'];
					$result["message"] = "User successfully authenticated.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User failed to be authenticated.";
				}
				echo json_encode($result);
				break;
				
			case "addUser":
				$check=mysqli_query($sql, "INSERT INTO `USER` ( `UNO` , `USERNAME`, `PASSWORD`, `DISPLAY`, `ULEVEL`) 
				VALUES( NULL, '".$data["username"]."','".$data["password"]."','".$data["displayn"]."','".$data["ulevel"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "User successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delUser":
				mysqli_query($sql, "DELETE FROM `USER` WHERE `USER`.`UNO`='".$data["usernum"]."'");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "User successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User failed to be deleted.";
				}
				echo json_encode($result);
				break;
				
			case "listUser":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM USER 
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "addQues":
				$check=mysqli_query($sql, "INSERT INTO `QUESTIONS` ( `QNO` , `SNAME`, `QDESC`, `QTYPE`, `QWORTH`, `ANSWER`, `NOTES` ) 
				VALUES( NULL, '".$data["sname"]."','".$data["qdesc"]."','".$data["qtype"]."','".$data["qworth"]."',
					   '".$data["answer"]."','".$data["notes"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "Question successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Question failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delQues":
				mysqli_query($sql, "DELETE FROM `QUESTIONS` WHERE `QUESTIONS`.`QNO`='".$data["quesnum"]."'");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "Question successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Question failed to be deleted.";
				}
				echo json_encode($result);
				break;
			
			case "listQues":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM QUESTIONS 
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "addExam":
				$check=mysqli_query($sql, "INSERT INTO `EXAMS` ( `ENO` , `ENAME`, `EDURATION`, `CDATETIME`, `MPSCORE`) 
				VALUES( NULL, '".$data["ename"]."','".$data["eduration"]."','".$data["cdatetime"]."','".$data["mpscore"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "Exam successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Exam failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delExam":
				mysqli_query($sql, "DELETE FROM `EXAMS` WHERE `EXAMS`.`ENO`='".$data["examnum"]."'");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "Exam successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Exam failed to be deleted.";
				}
				echo json_encode($result);
				break;
				
			case "listExam":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM EXAMS
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "addEQues":
				$check=mysqli_query($sql, "INSERT INTO `EXAMQ` ( `ENO` , `ELINE`, `QNO`) 
				VALUES( '".$data["eno"]."', NULL, '".$data["qno"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "Exam-Question Relation successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Exam-Question Relation failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delEQues":
				mysqli_query($sql, "DELETE FROM `EXAMQ` WHERE `EXAMQ`.`ENO`='".$data["eno"]."'
				AND `EXAMQ`.`ELINE`='".$data["eline"]."' ");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "Exam-Question Relation successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Exam-Question Relation failed to be deleted.";
				}
				echo json_encode($result);
				break;
				
			case "listEQues":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM EXAMQ
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "addUExam":
				$check=mysqli_query($sql, "INSERT INTO `UEXAM` ( `UNO`, `ENO` , `TSCORE`, `STIME` ) 
				VALUES( '".$data["uno"]."', '".$data["eno"]."', '".$data["tscore"]."','".$data["stime"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "User-Exam Relation successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User-Exam Relation failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delUExam":
				mysqli_query($sql, "DELETE FROM `UEXAM` WHERE `UEXAM`.`ENO`='".$data["eno"]."'
				AND `UEXAM`.`UNO`='".$data["uno"]."' ");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "User-Exam Relation successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User-Exam Relation failed to be deleted.";
				}
				echo json_encode($result);
				break;
				
			case "listUExam":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM UEXAM
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "addUEAns":
				$check=mysqli_query($sql, "INSERT INTO `USEREANS` ( `UNO`, `ENO` , `ELINE`, `UANS` ) 
				VALUES( '".$data["uno"]."', '".$data["eno"]."', '".$data["eline"]."','".$data["uans"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "User-Exam Answer successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User-Exam Answer failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "delUEAns":
				mysqli_query($sql, "DELETE FROM `USEREANS` WHERE `USEREANS`.`ENO`='".$data["eno"]."'
				AND `USEREANS`.`UNO`='".$data["uno"]."' 
				AND `USEREANS`.`ELINE`='".$data["eline"]."'");
				$numdel = mysqli_affected_rows($sql);
				if ($numdel)
				{
					$result["result"] = true;
					$result["message"] = "User-Exam Answer successfully deleted.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "User-Exam Answer failed to be deleted.";
				}
				echo json_encode($result);
				break;
				
			case "listUEAns":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM USEREANS
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			
			case "addQues2":
				$check=mysqli_query($sql, "INSERT INTO `QUESTIONS2` ( `QNO` , `SNAME`, `QDESC`, `OPT1`, `OPT2`, `OPT3`, `OPT4`, `QTYPE`, `QWORTH`, `ANSWER`, `NOTES` ) 
				VALUES( NULL, '".$data["sname"]."','".$data["qdesc"]."','".$data["opt1"]."','".$data["opt2"]."','".$data["opt3"]."','".$data["opt4"]."','".$data["qtype"]."','".$data["qworth"]."',
					   '".$data["answer"]."','".$data["notes"]."')");
				
				if ($check)
				{
					$result["result"] = true;
					$result["message"] = "Question2 successfully added.";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Question2 failed to be added.";
				}
				echo json_encode($result);
				break;
				
			case "listQues2":
				
				$query=mysqli_query($sql, "
					SELECT * 
					FROM QUESTIONS2 
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
			
			case "listSEQues":
				
				$query=mysqli_query($sql, "
					SELECT UEXAM.UNO, EXAMS.ENO, EXAMQ.ELINE, QUESTIONS2.*
					FROM UEXAM
						JOIN EXAMS
							ON EXAMS.ENO = UEXAM.ENO
						JOIN EXAMQ
							ON EXAMQ.ENO = EXAMS.ENO
						JOIN QUESTIONS2
							ON QUESTIONS2.QNO = EXAMQ.QNO
					WHERE UEXAM.UNO='".$data["uno"]."'
					AND UEXAM.ENO='".$data["eno"]."'
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
				
				case "listEUAns":
				
				$query=mysqli_query($sql, "
					SELECT UEXAM.UNO, EXAMS.ENO, EXAMQ.ELINE, QUESTIONS2.*, USEREANS.UANS
					FROM UEXAM
						JOIN EXAMS
							ON EXAMS.ENO = UEXAM.ENO
						JOIN EXAMQ
							ON EXAMQ.ENO = EXAMS.ENO
						JOIN QUESTIONS2
							ON QUESTIONS2.QNO = EXAMQ.QNO
						JOIN USEREANS
							ON USEREANS.UNO = UEXAM.UNO
							AND USEREANS.ENO = UEXAM.ENO
							AND USEREANS.ELINE = EXAMQ.ELINE
					WHERE UEXAM.UNO='".$data["uno"]."'
					AND UEXAM.ENO='".$data["eno"]."'
				");
				$rowtot = 0;
				while($row=mysqli_fetch_assoc($query)){
					$result[]=$row;
					$rowtot++;
				}
				
				if ( $rowtot > 0)
				{
					$result["result"] = true;
					$result["message"] = "Query Successful";
					$result["data"] = "Query Output";
				}
				else
				{
					$result["result"] = false;
					$result["message"] = "Query Failed";
				}
				echo json_encode($result);
				break;
		}
	}
?>
