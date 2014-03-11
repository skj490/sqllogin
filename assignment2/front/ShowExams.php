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
        <li><a href="Student.php" title="Home">Home</a></li>
        <li class="active"><a href="ShowExams.php" title="TestBank">Exams Due</a></li>
        <li><a href="ShowGrades.php" title="My Grades">My Grades</a></li>
        <li><a href="about2.php" title="About">About</a></li>
        <li><a href="index.html" title="Loggout">Loggout</a></li>
      </ul>
    </nav>
  </section>
  
  <section class="container2">
  <div class="login">
  	<form id="login" action="ListEx.php" method="post" style="text-align: center">
    	<table><?php
			include 'ListEx.php'
		?></table>
     
     
     &nbsp;
     &nbsp;
     <br><input type="submit" name="login" value="submit">
     <input type="hidden" name="action" value="listEQues">
    
    
    
    
      </form>
  </div>
  </section>
  
</body>
</html>
