<?php
session_start();
?>
<html>
<head>
<title>End of Task - OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<?php
  		if($_SESSION['CUSTOM_URL'] == 1) {
  			echo "<h1>Thank You for completing the first portion of this task!</h1>";
  			echo "<h2>Click the link below<br>to continue to the<br>second portion of the task.</h2>";
     		echo '<a href='.$_SESSION['final_URL'].'>'.'Continue to Part 2 of this HIT</a>';
  		} else {
  			echo "<h1>Thank You for completing this task!</h1>";
  			echo "<h2>Unique code:<u>".$_SESSION['part_id']."</u></h2>";
  		}
  		?>
  		<hr>
  		<h5>Please write down the email below to report any issues experienced while completing this study
      	<br><a href="mailto:nelsonroquejr@gmail.com">nelsonroquejr@gmail.com</a></h5>
  		<hr>
  	</div>
</div>
</body>
</html>