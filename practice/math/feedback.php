<?php
session_start();

if ($_SESSION['accuracy'] == "1") {
	$acc_label = "Correct";
} 
else {
	$acc_label = "Incorrect";
}
?>
<html>
<head>
<title>Feedback - OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div id="mean_accuracy">
	<?php
	$trial = $_SESSION['trial'];
	$mean = round((($_SESSION['mean_acc']/$trial)*100),1);
	$mean = $mean."%";
	echo($mean);
	?>
</div>
<br>
<div class="container">
  <div id="feedback_area">
  <p id="big_feedback"><?php 
  echo($acc_label);
  ?></p>
  </div>
</div>
</body>
<script>
var timeoutNextTrial = 2000;
function nextTrial () {
	window.location.replace("http://cognitivetask.com/aospan/practice/math/math.php");
}
setTimeout(function() {nextTrial()},timeoutNextTrial);
</script>
</html>