<?php
session_start();

function calc_mean($arr) {
    $count = count($arr);
    foreach ($arr as $value) {
        $total = $total + $value;
    }
    $average = ($total/$count);
    return $average;
}

function calc_sd($mean,$arr) {
    $sum = 0;
    $count = count($arr);
    foreach ($arr as $value) {
        $diff = $value - $mean;
        $sum = $sum + $diff;
    }
    $sum_sq = $sum * $sum;
    $average_sq_error = ($sum_sq/$count);
    return sqrt($average_sq_error);
}

$RT_arr = $_SESSION['all_RTs'];
$mean_RT = calc_mean($RT_arr);
$sd_RT = calc_sd($mean_RT,$RT_arr);
$sd_adj = $sd_RT * 2.5;

$_SESSION['trial'] = 0;
$_SESSION['presentation_count'] = 1;
$_SESSION['timeout'] = ($mean_RT + $sd_adj + 1)*1000;
?>
<html>
<head>
<title>OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<h1>Practice: Math + Letters</h1>
        <!--<h3>timeout = <?php echo ($_SESSION['timeout']); ?></h3>-->
      <div id="col1">
        <p><b>Now you will practice doing both parts of the experiment at the same time.</b> 
            In the next practice set, you will be given one of the math problems. Once 
            you make your decision about the math problem, a letter will appear on the screen. 
            Try and remember the letter.
        </p>
        <hr>
        <p>
            In the previous section where you only solved math problems, 
            the computer computed your average time to solve the problems. 
            <br><br>
            <b>If you take longer than your average time, the computer will automatically move you onto the next 
            letter part, thus skipping the True or False part and will count that problem as a math speed error. 
            Therefore it is VERY important to solve the problems as quickly and as accurately as possible.</b> 
        </p>
        <p> 
            After the letter goes away, another math problem will appear, and then another letter. 
            At the end of each set of letters and math problems, a recall screen will appear. 
            Use the mouse to select the letters you just saw. 
            <br><br>
            <b>Try your best to get the letters in the correct order.</b>
        </p>
        <hr>
        <p> 
            <b>It is important to work QUICKLY and ACCURATELY on the math.</b> Make sure you know the answer to the 
            math problem before clicking to the next screen.<br><br>You will not be told if your answer to the math 
            problem is correct. After the recall screen, you will be given feedback about your performance 
            regarding both the number of letters recalled and the percent correct on the math problems. 
        </p>
        <p>
            During the feedback, you will see a number in red in the top right of the screen. 
            This indicates your percent correct for the math problems for the entire experiment. 
            <b>It is VERY important for you to keep this at least at 85%.</b> 
        </p>
        <hr>
        <p>
            For our purposes, we can only use data where the participant was at least 85% accurate on the math,
            <b>so you must perform at least at 85% on the math problems WHILE doing your best to recall as many letters as possible.</b>
        </p>
      </div>
  	</div>
    <div id="form_area">
	    <form action="start_exp.php" method="post">
		    <input class="standard_button_green" type="submit" value="START">
	    </form>
    </div>
</div>
</body>
</html>