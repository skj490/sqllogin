<?php
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
		}
	}
?>
