<?php
# start session for data transfer
session_start();

$math_probs_array = array("(1/1)", "(2/1)", "(2/2)", "(3/1)", "(3/3)", "(4/1)", "(4/2)", "(4/4)", "(5/1)", "(5/5)", "(6/1)", "(6/2)", "(6/3)", "(6/6)", "(7/1)", "(7/7)","(8/1)", "(8/2)", "(8/4)", "(8/8)", "(9/1)", "(9/3)", "(9/9)", "(1*2)", "(1*3)", "(2*2)", "(1*4)", "(1*5)", "(3*2)", "(2*3)", "(1*6)", "(1*7)", "(4*2)", "(2*4)", "(1*8)", "(3*3)", "(1*9)", "(5*2)", "(2*5)", "(6*2)", "(4*3)", "(3*4)", "(2*6)", "(7*2)", "(2*7)", "(5*3)", "(3*5)", "(8*2)","(4*3)", "(3*4)", "(2*6)", "(7*2)", "(2*7)", "(5*3)", "(3*5)", "(8*2)","(8/1)", "(8/2)", "(8/4)", "(8/8)", "(9/1)", "(9/3)", "(9/9)", "(1*2)","(1/1)", "(2/1)", "(2/2)", "(3/1)", "(3/3)","(1*3)", "(2*2)", "(1*4)", "(1*5)", "(3*2)","(1*6)");
$set_size_array = array(3,3,3,4,4,4,5,5,5,6,6,6,7,7,7);

# implode both arrays for saving to session
$math_probs_array_implode = implode("|",$math_probs_array);
$set_size_array_implode = implode("|",$set_size_array);

$_SESSION['every_single_math_problem'] = $math_probs_array;#_implode;
$_SESSION['every_single_set_size'] = $set_size_array;#_implode;

# prepare for a new experiment
$_SESSION['max_presentations'] = 75; 				# max trials to have in real study, 75
$_SESSION['clicked'] = '';					# clear clicked responses
$_SESSION['resp_errors_total'] = 0; 		# accuracy errors, different from speed errors;
$_SESSION['resp_errors_trial'] = 0;
$_SESSION['speed_errors_total'] = 0;
$_SESSION['speed_errors_trial'] = 0;
$_SESSION['presentation_count'] = 1;


# create file for writing data
$myfile = fopen($_SESSION['task_data_filename'], "a") or die("Unable to open file!");
$txt = "width"."\t"."height"."\t"."browser"."\t"."version"."\t"."platform"."\t"."UA"."\t"."date"."\t"."time"."\t"."worker_id"."\t"."part_id"."\t"."study"."\t"."trial"."\t"."set_size"."\t"."presentation"."\t"."pres_count_full"."\t"."resp_err_totl"."\t"."speed_err_tottl"."\t"."difficulty"."\t"."math_ques"."\t"."math_ans"."\t"."given_resp"."\t"."math_acc"."\t"."math_user_resp"."\t"."RT"."\t"."ltr_seq"."\t"."ltr_resp"."\t"."ltr_acc"."\n";
fwrite($myfile, $txt);
fclose($myfile);

# move to the generation of trial stimuli
header("Location: http://cognitivetask.com/aospan/task/gen.php");
?>