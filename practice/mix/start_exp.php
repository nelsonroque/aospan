<?php
# start session for data transfer
session_start();

# prepare for a new experiment
$_SESSION['max_trials'] = 3; # max trials to have
$_SESSION['clicked'] = '';
$_SESSION['resp_errors_total'] = 0; # accuracy errors, different from speed errors;
$_SESSION['resp_errors_trial'] = 0;
$_SESSION['speed_errors_total'] = 0;
$_SESSION['speed_errors_trial'] = 0;


# create file for writing data
$myfile = fopen($_SESSION['mix_data_filename'], "a") or die("Unable to open file!");
$txt = "width"."\t"."height"."\t"."browser"."\t"."version"."\t"."platform"."\t"."UA"."\t"."date"."\t"."time"."\t"."worker_id"."\t"."part_id"."\t"."study"."\t"."trial"."\t"."set_size"."\t"."presentation"."\t"."pres_count_full"."\t"."resp_err_totl"."\t"."speed_err_tottl"."\t"."difficulty"."\t"."math_ques"."\t"."math_ans"."\t"."given_resp"."\t"."math_acc"."\t"."math_user_resp"."\t"."RT"."\t"."ltr_seq"."\t"."ltr_resp"."\t"."ltr_acc"."\n";
fwrite($myfile, $txt);
fclose($myfile);

# move to the generation of trial stimuli
header("Location: http://cognitivetask.com/aospan/practice/mix/gen.php");
?>