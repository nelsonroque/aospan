<?php
session_start();
$_SESSION['max_trials'] = 15;
$_SESSION['mean_acc'] = 0;

$all_probs= array("(1*2)","(1/1)","(7*3)","(4*3)","(3/3)","(2*6)","(8*9)","(4*5)","(4*2)","(4/4)","(8*2)","(2*9)","(8/2)","(3*8)","(6/3)","(9/3)");
$all_nums = array('1','1','3','4','2','4','8','5','6','7','8','9','9','1','1','2');
$all_signs = array("+", "-", "-" , "+", "+", "-", "-" , "-", "+", "+","-", "-","+","-","+","-");
$all_ans = array("3","2","18","16","1","6","64","11","14","12","2","9","7","23","3","7");

$_SESSION['all-probs'] = $all_probs;
$_SESSION['all-nums'] = $all_nums;
$_SESSION['all-signs'] = $all_signs;
$_SESSION['all-ans'] = $all_ans;
$_SESSION['all_RTs'] = array();


$myfile = fopen($_SESSION['math_data_filename'], "a") or die("Unable to open file!");
$txt = "width"."\t"."height"."\t"."browser"."\t"."version"."\t"."platform"."\t"."UA"."\t"."date"."\t"."time"."\t"."worker_id"."\t"."part_id"."\t"."study"."\t"."trial"."\t"."math_ques"."\t".
	   "math_ans". "\t". "given_resp". "\t"."user_resp"."\t"."acc"."\t"."difficulty"."\t"."RT"."\n";
fwrite($myfile, $txt);
fclose($myfile);

header("Location: http://cognitivetask.com/aospan/practice/math/math.php");
?>