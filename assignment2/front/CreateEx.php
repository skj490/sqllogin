<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Teacher Section</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <section class="container">
    <nav>
      <ul class="nav">      
        <li ><a href="Teacher.php" title="Home">Home</a></li>
        <li><a href="ListQ.php" title="TestBank">Test Bank</a></li>
        <li><a href="MakeQues.php" title="Add question">Create Question</a></li>
        <li class="active"><a href="CreateEx.php" title="Create Exam">Create Exam</a></li>        
        <li><a href="ListEx.php" title="Show Exam">Show Exams</a></li>
        <li><a href="about.php" title="About">About</a></li>
        <li><a href="index.html" title="Loggout">Loggout</a></li>
      </ul>
    </nav>
    </section>
    <section class="container">
    <a href="#" class="button" onClick="fun2('1','2','3')">Add Exam</a>
  	<a href="#" class="button" onclick="fun2('2','3','1')">Add Questions to Exam</a>
    <a href="#" class="button" onclick="fun2('3','1','2')">Add User to Exam</a>
    </div>
  </section>
  <section class="container2">
  <div class="login" id="1" style="display:none">
  <form id="login" action="addEx.php" method="post" style="text-align: center">
	    Exam Name: <input type="text" name="ename" placeholder="Exam Name"><br>
	    Exam Duration: <input type="text" name="eduration" placeholder="Exam Duration"><br>
		Cut off date/time: <input type="text" name="cdatetime" placeholder="Cut off date/time"><br>
		Max Possible Score: <input type="text" name="mpscore" placeholder="Max Score"><br>
        <br><input type="submit" name="login" value="submit" class="button"><br>
		<input type="hidden" name="action" value="addExam">
        
    </form>
    </div>
    
    <div class="login" id="2" style="display:none">    
    
    <form id="login" action="addEUQ.php" method="post" style="text-align: center">   
         Exam Number: <input type="text" name="eno" placeholder="Exam Number"><br>
        <br>
        <table><?php
			include 'ListQ.php';
        	//print("<input type='text' name='eno' placeholder='Exam Number'/>");			
        ?></table>
       
	    <!--Question Number: <input type="text" name="qno" placeholder="Question Number"><br>-->
        <br><input type="submit" name="login" value="submit" class="button"><br>
		<input type="hidden" name="action" value="addEQues">
    </form>

    </div>
    
  	<div class="login" id="3" style="display:none">
    <form id="login" action="addUE.php" method="post" style="text-align: center">
	    User Number: <input type="text" name="uno" placeholder="User Number"><br>
		Exam Number: <input type="text" name="eno" placeholder="Exam Number"><br>
		Total Score: <input type="text" name="tscore" placeholder="Total Score"><br>
		Start Time: <input type="text" name="stime" placeholder="Start Time"><br>
        <br><input type="submit" name="login" value="submit" class="button"><br>
	    <!--<button id="sub">Submit</button>-->
		<input type="hidden" name="action" value="addUExam">
    </form>
    </div>
    
    </section>
    
    
  
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src= "js/block.js"></script>    
</body>
</html>
