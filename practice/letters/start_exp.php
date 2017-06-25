<?php
session_start();
$_SESSION['screen_width'] = $_POST['win_width'];
$_SESSION['screen_height'] = $_POST['win_height'];
$_SESSION['max_trials'] = 4;

$prac_letters = array('F','P','Q','J','H','K','T','S','N','R');
$prac_sets = array(3,3,2,2);
$_SESSION['remaining-letters'] = $prac_letters;
$_SESSION['remaining-sets'] = $prac_sets;


header("Location: http://cognitivetask.com/aospan/practice/letters/letters.php");

$myfile = fopen($_SESSION['letters_data_filename'], "a") or die("cannot open file");
$txt = "width"."\t"."height"."\t"."browser"."\t"."version"."\t"."platform"."\t"."UA"."\t"."date"."\t"."time"."\t"."worker_id"."\t"."part_id"."\t"."study"."\t"."trial"."\t"."set_size"."\t"."letters"."\t"."response"."\t"."correct"."\n";
fwrite($myfile, $txt);
fclose($myfile);
?>