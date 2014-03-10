<?php
header("Content-Type: application/json");

//COMMENT OR UNCOMMENT THESE LINES IF YOU WANT TO SEE ERROR MESSAGES TO HELP WITH DEBUGGING
ini_set('display_errors',1);
ini_set('memory_limit','64M');
//echo ini_get("memory_limit");
error_reporting(E_ALL);

//VARIABLES TO COME FROM FRONT TO SELECT THE EXAM TO GRADE
$user_number = $_POST["exam_number"];
$exam_number = $_POST["user_number"];

//VARIABLES FOR OPEN ENDED GRADING
$exam_data = get_test($user_number,$exam_number);
$cases = get_cases($exam_data);
$student_code = get_response($exam_data);
$function_name = get_function_name($student_code);
$assoc = create_test_assoc($cases);
$total_grade = 0;
$output = array();

//constants for file_name creation and student code template
$PYTHON = ".py";

//python template
$pyt = "from sys import argv\n\n";
$pyt .= "filename, first, second = argv\n\n";
$pyt .= "{$student_code}";
$pyt .= "\nans = {$function_name}(first,second)\n";
$pyt .= "\nprint(ans)\n";
$pyt .= "#sys.stdout.flush()\n";

function get_test($exam, $user)
{
	$action = "listEUAns";

	$data = http_build_query(array(
		"eno" => $exam,
		"uno" => $user,
		'action' => $action
	));


	$crl=curl_init();
	curl_setopt($crl, CURLOPT_URL,"http://web.njit.edu/~jeb26/php_sandbox/request.php");
	//curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $data/*_string*/ );
	//curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($crl);
	curl_close($crl);

	$json = json_decode($res,true);

	return $json;
}

function createFile($language_type, $fname, $code)
{
	$file_name = $fname . $language_type;
	
	//return $file_name;
	//echo $file_name;
	//echo $fname;
	//echo $language_type;
	
	if(file_put_contents($file_name,$code))
	{
		return $file_name;
	}
	else 
	{
		return false;
	}
}

function get_cases($data)
{
	foreach ($data as $ques_id => $ques_content) 
	{
		if(is_array($ques_content))
		{
			foreach ($ques_content as $field_name => $field_value) 
			{
				//echo "field name: " . $field_name . " value: " . $field_value . "<br />";
				if($field_name == "QTYPE" && $field_value == 4)
				{
					//print_r($ques_content);
					$input = $ques_content['ANSWER'];
					$cases = explode("\n", $input);

					return $cases;
					//echo "<pre>$input</pre>";
					//this will change to coresspond to where the student response actually is held
					//$response = $ques_content['ANSWER'];
					//echo $cases;
				}
			}
		}
	}
}

//print_r($cases);
//print_r($exam_data);

function get_response($data)
{
	foreach ($data as $ques_id => $ques_content) 
	{
		if(is_array($ques_content))
		{
			foreach ($ques_content as $field_name => $field_value) 
			{
				//echo "field name: " . $field_name . " value: " . $field_value . "<br />";
				if($field_name == "QTYPE" && $field_value == 4)
				{
					//print_r($ques_content);
					$input = $ques_content['UANS'];
					//$cases = explode("\n", $input);

					return $input;
					//return $cases;
					//echo "<pre>$input</pre>";
					//this will change to coresspond to where the student response actually is held
					//$response = $ques_content['ANSWER'];
					//echo $cases;
				}
			}
		}
	}
}

//print_r($student_code);

function get_function_name($code)
{
	//explode on \n
	$lines_in_code = explode("\n", $code);
	
	//take elem 1
	$first_line = $lines_in_code[0];

	//explode on (
	$func_sig = explode("(", $first_line);

	//take elem 1
	$sig  = $func_sig[0];

	//explode on " "
	$func_keyword = explode(" ", $sig);

	//take last elem
	$len = sizeof($func_keyword);
	$last_elem = $len - 1;

	//get the function name
	//$func_name = func_keyword[$last_elem];
	$func_name = $func_keyword[$last_elem];

	return $func_name;

}

//print_r($function_name);

function create_test_assoc($cases)
{
	$index = 0;
	$assoc = array();

	foreach ($cases as $key) {
		$brackets = array("[","]");
		$str = $key;
		$strip = str_replace($brackets, "", $str);
		$test_array = explode(",", $strip);
		$success_case = array_pop($test_array);
		$t_params = implode(",", $test_array);
		$params = str_replace(",", " ", $t_params);

		//print_r($params);
		//echo $params . "<br />";
		
		$assoc[] = array(
			"params" => $params,
			"success_case" => $success_case,
			"error" => 0,
			"output" => 0
		);
		//$index++;
	}
	//print_r($json);
	return $assoc;
}

	$descriptorspec = array(
		0 => array("pipe", "r"), // stdin is a pipe that the child will read from
		1 => array("pipe", "w"), // stdout is a pipe that the child will write to
		//2 => array("file","./error.log","a")
		2 => array("pipe", "w")
	);
	$cwd = getcwd();
	$env = array('some_option' => 'aeiou');

function compile($file_name, $lang_type, $command, $case, $iter, &$array, $ds, $cwd,$env)
{
	//creating the compile command
	$cmd = $command ." ". $file_name ." ". $case;
	//$cmd = "python" ." ". $file_name ." ". $case;

	//variables nesecary to start process

	//open the process
	$process = proc_open($cmd, $ds, $pipes, $cwd, $env);

	if (is_resource($process))
	{
		$array[$iter]['lang'] = $lang_type;

		$array[$iter]['command'] = $cmd;

		//$array[$iter]['c1'] = stream_get_contents($pipes[0]);
		fclose($pipes[0]);

		$array[$iter]['output'] = stream_get_contents($pipes[1]);
		fclose($pipes[1]);

		//$array[$iter]['stream'] = stream_get_contents($pipes[2]);
		fclose($pipes[2]);

		$return_value = proc_close($process);

		$array[$iter]['error'] = $return_value;
	}
	/*
	//debugging info
	if($array["crv-case-".$iterator] != 0)
	{
		$array["error-case-".$iterator] = $return_value;
	}
	else if($array["crv-case-".$iterator] == 0)
	{
		$array["error-case-".$iterator] = 0;
	}
	*/
}

function runtest($filename, $lang_ext, $lang_name, &$assoc, $ds, $cwd, $env)
{
	$index = 0;
	$tests = $assoc;
	foreach ($tests as $key => $value) {
		//echo "key: " . $key . "value: ". $value . "<br />";
		foreach ($value as $k => $v) {
			//echo "parameters " . $value['params'] . "<br />";
			if($k == "params")
			{
				//echo "v is: " . $v . "<br/>";
				compile($filename, $lang_ext, $lang_name,$v, $index, $assoc, $ds, $cwd,$env);
			}
		}
		$index++;
	}
}

function main($lang, $fn, $code, $cases, &$arr, $ds, $cwd,$env)
{
	//createFile($JAVA, $file_name, $str);
	//$fn = createFile($JAVA, $file_name, $str);

	if(!($f = createFile($lang, $fn, $code)))
	{
		//following code runs if file creation fails
		die("file creation failed");
	}
	else
	{
		//following code run if file creation suceeds
		//compileCode($f, $lang);
		//echo "file creation success!" . "<br />";
		//echo "filename: " . $f . "<br />";
		//echo "code added to file: " . "<pre>" . $code . "</pre>". "<br /><hr />";
		//echo "compile results: <br />";
		//$assoc = create_test_assoc($cases);
		//print_r($assoc);
		runtest($f, $lang, "python", $arr, $ds, $cwd,$env);
		//compile($f, $PYTHON, "python", "2 3", $arr);
		//print_r($assoc);
		//runtest($json);
	}

//echo $fn;

}
//print_r($cases);

main($PYTHON, $function_name, $pyt, $cases, $assoc, $descriptorspec, $cwd,$env);

//print_r($assoc);

//calcuate grade iA

$num_ques = 0;
foreach ($exam_data as $key => $value) {
	if(is_array($value))
	{
		$curr_ans = "";
		$student_ans = "";	

		if($exam_data[$key]['ANSWER'] == $exam_data[$key]['UANS'])
		{
			$total_grade += $exam_data[$key]['QWORTH'];
		}
		elseif ( ($exam_data[$key]['ANSWER'] != $exam_data[$key]['UANS']) && ($exam_data[$key]['QTYPE'] != "4")) {
			$output[$key] = $exam_data[$key]['QDESC'];
		}
		$num_ques++;
	}
}

$num_ques++;
$output['exam-grade'] = $total_grade;
//echo $total_grade . "\n";
$output['open-ended'] = $assoc;
echo json_encode($output, true);
?>
