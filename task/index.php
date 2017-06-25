<?php
session_start();
$_SESSION['current_presentation_trial'] = 1;
$_SESSION['presentation_count'] = 0;
?>
<html>
<head>
<title>OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<h1>EXPERIMENT PHASE</h1>
      <br>
      <p><b>The real trials will look like the practice trials you just completed.</b> First you will get a math problem to solve, then a letter to remember.
      </p>
      <hr>
      <p>
      When you see the recall screen, select the letters <b>in the order presented</b>. If you forget a letter, click the BLANK box to mark where it should go. 
      </p>
      <p>
      Some of the sets will have more math problems and letters than others. It is important that you do your best on both the math problems and the letter recall parts of this experiment.
      </p>
      <hr>
      <p>
      <b>Remember on the math you must work as QUICKLY and ACCURATELY as possible. Also, remember to keep your math accuracy at 85% or above.</b>
      </p>
  	</div>
    <div id="form_area">
	    <form action="start_exp.php" method="post">
		    <input class="standard_button_green" type="submit" value="START">
	    </form>
    </div>
</div>
</body>
</html>