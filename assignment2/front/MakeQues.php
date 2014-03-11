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
        <li class="active"><a href="MakeQues.html" title="Add question">Create Question</a></li>
        <li><a href="CreateEx.php" title="Create Exam">Create Exam</a></li>
        <li><a href="ListEx.php" title="Show Exam">Show Exams</a></li>
        <li><a href="about.php" title="About">About</a></li>
        <li><a href="index.html" title="Loggout">Loggout</a></li>
      </ul>
    </nav>
  </section>
  <section class="container">
  	<a href="#" class="button" onClick="fun('1','2','3','4')">True/False</a>
  	<a href="#" class="button"  onclick="fun('2','4','3','1')">Multuple Choice</a>
    <a href="#" class="button"  onclick="fun('3','1','2','4')">Open Ended</a>
    <a href="#" class="button"  onclick="fun('4','3','1','2')">Program</a>
    
  </section>
<section class="container2">
  	<div class="login" id="2" style="display:none;">
  		<form id="login" action="request.php" method="post" style="text-align: center">
    		<span style="font-weight: bold">Create Multiple Choice Question</span><br>
            
            <br> Question Summary: 
            <input type="text" name="sname" placeholder="Question Summary"></br>
            
            Question: 
            <br><textarea name="qdesc" placeholder="Please enter question" style="width:300px;height:95px;"></textarea> </br>
            
            Question Value:
            <input type="text" name="qworth" placeholder="Worth in points"></br>
            
            <br>Answer A:
            <input type="radio" name="answer" value="opt1">
            <input type="text" style="width:auto" name="opt1">
            <br>Answer B:
            <input type="radio" name="answer" value="opt2">
            <input type="text" style="width:auto" name="opt2">
            <br>Answer C:
            <input type="radio" name="answer" value="opt3">
            <input type="text" style="width:auto" name="opt3">
            <br>Answer D:
            <input type="radio" name="answer" value="opt4">
            <input type="text" style="width:auto" name="opt4"></br>
            
            <!--<br>Correct Answer<br>
            <input type-"text" style="width:auto" name="answer"></br>-->
            
            <br>Notes:
            <br><textarea type="text" name="notes" rows="5" placeholder="Question Notes"></textarea>
            
          <br>
            <input type="hidden" value="2" name="qtype">
            <input type="hidden" value="addQues2" name="action">
            <br><input type="submit" name="login" value="submit" class="button">
      </form>
      </div>
      
      <div class="login" id="1" style="display:none;">
  		<form id="login" action="request.php" method="post" style="text-align: center">
    		<span style="font-weight: bold">Create True or False Question</span><br>
            
            <br> Question Summary: 
            <input type="text" name="sname" placeholder="Question Summary"></br>
            
            Question: 
            <br><textarea name="qdesc" placeholder="Please enter question" style="width:300px;height:95px;"></textarea> </br>
            
            Question Value:
            <input type="text" name="qworth" placeholder="Worth in points"></br>
            
            <br>Answer T:
            <input type="radio" name="answer" value="True" >
            <input type="text" style="width:auto" name="opt1" value="True">
            <br>Answer F:
            <input type="radio" name="answer" value="False" >
            <input type="text" style="width:auto" name="opt2" value="False">
            
            
            <input type="hidden" style="width:auto"  name="opt3">
            
            
            <input type="hidden" style="width:auto" name="opt4"></br>
            
            <br>Notes:
            <br><textarea type="text" name="notes" rows="5" placeholder="Question Notes"></textarea>
            
          <br>
            <input type="hidden" value="1" name="qtype">
            <input type="hidden" value="addQues2" name="action">
            <br><input type="submit" name="login" value="submit" class="button">
      </form>
      </div>
      
      <div class="login" id="3" style="display:none;">
  		<form id="login" action="request.php" method="post" style="text-align: center">
    		<span style="font-weight: bold">Create Open Ended</span><br>
            
            <br> Question Summary: 
            <input type="text" name="sname" placeholder="Question Summary"></br>
            
            Question: 
            <br><textarea name="qdesc" placeholder="Please enter question" style="width:300px;height:95px;"></textarea> </br>
            
            Question Value:
            <input type="text" name="qworth" placeholder="Worth in points"></br>
            
            Answer:
            <textarea name="answer" placeholder="Please enter answer for OE question" style="width:300px;height:95px"></textarea>
            
            <input type="hidden" style="width:auto" name="opt1">
            <input type="hidden" style="width:auto" name="opt2">  
          	<input type="hidden" style="width:auto"  name="opt3">
            <input type="hidden" style="width:auto" name="opt4"></br>
            
            <br>Notes:
            <br><textarea type="text" name="notes" rows="5" placeholder="Question Notes"></textarea>
            
          <br>
            <input type="hidden" value="3" name="qtype">
            <input type="hidden" value="addQues2" name="action">
            <br><input type="submit" name="login" value="submit" class="button">
      </form>
      </div>
      
      <div class="login" id="4" style="display:none;">
  		<form id="login" action="request.php" method="post" style="text-align: center">
    		<span style="font-weight: bold">Programming Question</span><br>
            
            <br> Question Summary: 
            <input type="text" name="sname" placeholder="Question Summary"></br>
            
            Question: 
            <br><textarea name="qdesc" placeholder="Please enter question" style="width:300px;height:95px;"></textarea> </br>
            
            Question Value:
            <input type="text" name="qworth" placeholder="Worth in points"></br>
            
            Answer:
            <textarea name="answer" placeholder="Please enter answer for Prog question" style="width:300px;height:95px"></textarea>
            
            <input type="hidden" style="width:auto" name="opt1">
            <input type="hidden" style="width:auto" name="opt2">  
          	<input type="hidden" style="width:auto"  name="opt3">
            <input type="hidden" style="width:auto" name="opt4"></br>
            
            <br>Notes:
            <br><textarea type="text" name="notes" rows="5" placeholder="Question Notes"></textarea>
            
          <br>
            <input type="hidden" value="4" name="qtype">
            <input type="hidden" value="addQues2" name="action">
            <br><input type="submit" name="login" value="submit" class="button">
      </form>
      </div>
      
</section>
            
            
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src= "js/block.js"></script>
</body>
</html>
