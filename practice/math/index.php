<?php
session_start();
$_SESSION['trial'] = 0;
?>
<html>
<head>
<title>OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<h1>Practice: Math</h1>
      <br>
      <p>Now you will practice doing the math part of the experiment. A math problem will appear on the screen, like this:
      <br>
(2 * 1) + 1 = ?
<hr>
As soon as you see the math problem, you should compute the correct answer.
In the above problem, the answer 3 is correct. When you know the correct answer, you will click the mouse button. You will see a number displayed on the next screen, along with a box marked TRUE and a box marked FALSE. 
<hr>
<b>If the number on the screen is the correct answer to the math problem, click on the TRUE box with the mouse.</b> 
<br><br>
<b>If the number is not the correct answer, click on the FALSE box.</b>
<hr>
For example, if you see the problem,
(2 * 2) + 1 = ?<br>
and the number on the following screen is 5<br>
click the TRUE box, because the answer is correct.<br>
<hr>
If you see the problem<br>
(2 * 2) + 1 =  ?<br>
and the number on the next screen is 6<br>
click the FALSE box, because the correct answer is 5, not 6.<br>
After you click on one of the boxes, the computer will tell you if you made the right choice. 
<hr>
<b>It is VERY important that you get the math problems correct. It is also important that you try and solve the problem as quickly as you can.</b><Br><Br> When you're ready, click the CONTINUE button.</p>
  	</div>
  	<div id="form_area">
	    <form action="start_exp.php" method="post">
		    <input class="standard_button_blue" type="submit" value="CONTINUE">
	    </form>
    </div>
</div>
</body>
</html>