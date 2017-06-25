<?php
session_start();

# is response true or false
if (isset($_POST['TRUE'])) {
	$UR = '1';
	$URs = "True";
}
elseif (isset($_POST['FALSE'])) {
	$UR = '0';
	$URs = "False";
}
elseif (!isset($_POST['TRUE'],$_POST['FALSE'])) {
	$UR = '2';
	$URs = "NR";
}
else {
	echo "what happened?";
}

# clean up answers (removing all extra chars)
$correct_resp = $_SESSION['correct-answer'];
$presented_resp = $_SESSION['given-response'];

$correct_resp = preg_replace("/\D/", '', $correct_resp);
$presented_resp = preg_replace("/\D/", '', $presented_resp);

# determine if true or false trial
if ($correct_resp == $presented_resp) {
	$trial_type = '1'; # true trial
}
elseif ($correct_resp <> $presented_resp) {
	$trial_type = '0'; # false trial
}

# determine accuracy
if ($trial_type === $UR) {
	$acc = 1;
	$error = 0;
}
elseif ($trial_type <> $UR) {
	$acc = 0;
	$error = 1;
}

$_SESSION['resp_errors_total'] += $error;
$_SESSION['resp_errors_trial'] += $error; 
$_SESSION['i_accuracy'] = $acc;
$_SESSION['math_user_resp'] = $URs;

header("Location: http://cognitivetask.com/aospan/practice/mix/letter.php");
?>