<?php
session_start();

# get accuracy for only this trial
$pres = $_SESSION['presentation'];
$total_error = $_SESSION['resp_errors_trial'] + $_SESSION['speed_errors_trial'];

# for adaptive label
if ($total_error <= 0) {
	$total_error = 0;
	$error_label = "error";
}
else {
	$error_label = "errors";
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
		$pres_total = $_SESSION['presentation_count'];
		$error = ($_SESSION['resp_errors_total'] + $_SESSION['speed_errors_total']);

		$correct = (($pres_total - $error)/($pres_total));
		$percent_correct = $correct * 100;
		$percent_accuracy = round($percent_correct,1);

		$percent_accuracy = "$percent_accuracy" . "%";

		echo($percent_accuracy);
	?>
</div>
<br>
<div class="container">
  <div id="feedback_area">
  <p>You recalled <?php echo $_SESSION['ltr_correct']; ?> out of <?php echo ($_SESSION['current-set']); ?> letters correctly.</p>
  <p>You made <?php echo $total_error; ?> math <?php echo $error_label; ?></p>
  </div>
</div>
</body>
<script>
var timeoutNextTrial = 2000;
function nextTrial () {
	window.location.replace("http://cognitivetask.com/aospan/task/gen.php");
}
setTimeout(function() {nextTrial()},timeoutNextTrial);
</script>
</html>
<?php 
$_SESSION['ltr_correct'] = '';
$_SESSION['resp_errors_trial'] = 0;
$_SESSION['speed_errors_trial'] = 0;
?>