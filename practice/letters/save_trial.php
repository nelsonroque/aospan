<?php
session_start();
$_SESSION['clicked'] = $_POST['clicky'];
$_SESSION['time'] = date("h:i:sa");

function compareIndices($set,$correct_string,$user_string) {
$var1 = $correct_string;
$var2 = $user_string;

$lengthCorrect = $set;

$i = 0;
$total_correct = 0;
while ($i < $lengthCorrect) {
	$comp1 = $var1[$i];
	$comp2 = $var2[$i];
	if ($comp1 === $comp2) {
		$total_correct += 1;
	} 
	else {
		$total_correct += 0;
	}
	$i += 1;
}
return $total_correct;
}

$correct = compareIndices (($_SESSION['current-set']),($_SESSION['current-letters']),($_SESSION['clicked']));
$_SESSION['correct'] = $correct;

$myfile = fopen($_SESSION['letters_data_filename'], "a") or die("Unable to open file!");
$txt = $_SESSION['screen_width']."\t".$_SESSION['screen_height']."\t".$_SESSION['b_name']."\t".$_SESSION['b_ver']."\t".$_SESSION['b_plt']."\t".$_SESSION['b_UA']."\t".$_SESSION['date']."\t".$_SESSION['time']."\t".$_SESSION['workerID']."\t".$_SESSION['part_id']."\t".$_SESSION['study']."\t".$_SESSION['trial']."\t".$_SESSION['current-set']."\t".$_SESSION['current-letters']."\t".$_SESSION['clicked']."\t".$_SESSION['correct']."\n";
fwrite($myfile, $txt);
fclose($myfile);

header("Location: http://cognitivetask.com/aospan/practice/letters/feedback.php");
?>