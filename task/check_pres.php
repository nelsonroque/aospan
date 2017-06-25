<?php
# start session for data transfer
session_start();

# prepare for a new experiment
$pres = $_SESSION['presentation'];
$set = $_SESSION['current-set'] - 1;

if ($pres == $set) {
	# move to letter response
	header("Location: http://cognitivetask.com/aospan/task/l_response.php");
}
else {
	$myfile = fopen($_SESSION['task_data_filename'], "a") or die("Unable to open file!");
	$_SESSION['time'] = date("h:i:sa");
	$txt = $_SESSION['screen_width']."\t".$_SESSION['screen_height']."\t".$_SESSION['b_name']."\t".$_SESSION['b_ver']."\t".$_SESSION['b_plt']."\t".$_SESSION['b_UA']."\t".$_SESSION['date']."\t".$_SESSION['time']."\t".$_SESSION['workerID']."\t".$_SESSION['part_id']."\t".$_SESSION['study']."\t".$_SESSION['current_presentation_trial']."\t".$_SESSION['current-set']."\t".$_SESSION['presentation']."\t".$_SESSION['presentation_count'] . "\t" . $_SESSION['resp_errors_total'] . "\t" . $_SESSION['speed_errors_total'] . "\t" . $_SESSION['difficulty']."\t".$_SESSION['current-math']."\t".$_SESSION['correct-answer']."\t".$_SESSION['given-response']."\t".$_SESSION['i_accuracy']."\t".$_SESSION['math_user_resp']."\t".$_SESSION['RT']."\t".$_SESSION['current-letters']."\t".$_SESSION['clicked']."\t".$_SESSION['ltr_correct']."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	
	# update presentation index
	$_SESSION['current_presentation_trial'] += 1;
	$_SESSION['presentation'] += 1;
	$_SESSION['presentation_count'] += 1;
	$_SESSION['clicked'] = '';

	# move to next math problem
	header("Location: http://cognitivetask.com/aospan/task/math.php");
}
?>