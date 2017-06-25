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

if (($_SESSION['correct-response'] == $_SESSION['given-response']) and ($UR == "1")) {
	$acc = "1";
}
elseif (($_SESSION['correct-response'] != $_SESSION['given-response']) and ($UR == "0")) {
	$acc = "1";
}
else {
	$acc = "0";
}

#$_SESSION['user-response'] = $UR;
$_SESSION['math_user_resp'] = $URs;
$_SESSION['accuracy'] = $acc;
$_SESSION['mean_acc'] += $acc;
$_SESSION['time'] = date("h:i:sa");

$myfile = fopen($_SESSION['math_data_filename'], "a") or die("Unable to open file!");
$txt = $_SESSION['screen_width']."\t".$_SESSION['screen_height']."\t".$_SESSION['b_name']."\t".$_SESSION['b_ver']."\t".$_SESSION['b_plt']."\t".$_SESSION['b_UA']."\t".$_SESSION['date']."\t".$_SESSION['time']."\t".$_SESSION['workerID']."\t".$_SESSION['part_id']."\t".$_SESSION['study']."\t".$_SESSION['trial']."\t".$_SESSION['current-math']."\t".$_SESSION['correct-response']."\t".$_SESSION['given-response']."\t".$_SESSION['math_user_resp']."\t".$_SESSION['accuracy']."\t".$_SESSION['difficulty']."\t".$_SESSION['RT']."\n";
fwrite($myfile, $txt);
fclose($myfile);

header("Location: http://cognitivetask.com/aospan/practice/math/feedback.php");
?>