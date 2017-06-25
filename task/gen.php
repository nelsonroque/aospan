<?php
# create session to transfer vars
session_start();

# max_trials in task
$max_presentations = $_SESSION['max_presentations'];
$_SESSION['presentation'] = 0;

# generate set size
function gen_set () {
  # get list of sets
  $all_sets = $_SESSION['every_single_set_size'];
  #$all_sets = explode($setPreExplode,"|");

  # shuffle it
  shuffle($all_sets);

  # pop current set
  $set_size = array_pop($all_sets);

  #$all_sets = implode($all_sets,"|");
  $_SESSION['every_single_set_size'] = $all_sets;

  # return it
  return $set_size;
}

# generate letter sequence
function gen_letters ($set_size) {
  # all possible trial elements
  $all_letters = array('F','H','J','K','L','N','P','Q','R','S','T','Y');

  # shuffle elements for trial
  shuffle($all_letters);

  # get current trial elements
  $letters = array_splice($all_letters,0,$set_size);
  $letters = implode("", $letters);

  return $letters;
}

# generate math problem
function gen_math () {
  # all possible trial elements
  $problems = $_SESSION['every_single_math_problem'];
  #$problems = explode("|",$mathPreExplode);
  $numbers = array('1','2','3','4','5','6','7','8','9');
  $sign = array('+','-');
  $given_answer = array("R","FP","FN");

  $answer = -1;

  # shuffle elements for trial
  shuffle($problems);
  shuffle($numbers);
  shuffle($sign);
  shuffle($given_answer);

  $current_problem = array_pop($problems);

  while ($answer <= 0) {
    # get current trial elements
    $current_num = array_pop($numbers);
    $current_sign = array_pop($sign);
    $this_answer = array_pop($given_answer);

    # get individual elements for math
    $current_num1 = $current_problem[1];
    $current_sign1 = $current_problem[2];
    $current_num2 = $current_problem[3];

    # multiplication/division operation
    switch($current_sign1) {
      case '*':
        $answer = $current_num1 * $current_num2;
        break;
      case '/':
        $answer = $current_num1 / $current_num2;
        break;
      default:
        $answer = "1symbol error -- check array";
        break;
    } # end switch * and /

    # addition/subtraction operation
    switch($current_sign) {
      case '+':
        $answer = $answer + $current_num;
        break;
      case '-':
        $answer = $answer - $current_num;
        break;
      default:
        $answer = "2symbol error -- check array";
        break;
    } # end switch + and -

    # get trial difficulty
    if ($answer > 0 and $answer <= 10) {
      $difficulty = "1";
    }
    elseif ($answer > 10 and $answer <= 20) {
      $difficulty = "2";
    }
    elseif ($answer > 20 and $answer <= 40) {
      $difficulty = "3";
    }
    elseif ($answer > 40) {
      $difficulty = "4";
    }

  } # end of while loop for no negative answers

    if ($this_answer == "R") {
      $given_answer2 = $answer;
    }
    elseif ($this_answer == "FP") {
      shuffle($numbers);
      $given_answer2 = $answer + array_pop($numbers);
    }
    elseif ($this_answer == "FN") {
      shuffle($numbers);
      $given_answer2 = $answer - array_pop($numbers);
    }

    while ($given_answer2 <= 0) {
      if ($this_answer == "FP") {
        shuffle($numbers);
        $given_answer2 = $answer + array_pop($numbers);
      }
      elseif ($this_answer == "FN") {
        shuffle($numbers);
        $given_answer2 = $answer - array_pop($numbers);
      }
    }

    #$problems = implode($problems,"|");
    $_SESSION['every_single_math_problem'] = $problems;

    $master_data = array($current_problem,$current_sign,$current_num,$difficulty,$answer,$given_answer2);

  return $master_data;
}

function gen_all_math($set_size) {
  # array for all math problems in set
  $master_math = array();

  # generate math data array
  $i = 0;
  while ($i < $set_size) {
    $_current_math = gen_math();
    $master_math[] = $_current_math;
    $i = $i + 1;
  }

  return $master_math;
}

# if final trial, redirect to end page
if ($_SESSION['current_presentation_trial'] >= $max_presentations) {
  header("Location: http://cognitivetask.com/aospan/task/end.php");
  $_SESSION['resp_errors_total'] = 0;
  $_SESSION['speed_errors_total'] = 0;
  $_SESSION['presentation_count'] = 0;
}
else {
  # generate set size
  $current_set_size = gen_set();

  # generate letters
  $letters = gen_letters($current_set_size);

  # generate math problems
  $all_math = gen_all_math($current_set_size);

  # Create all session variables
  $_SESSION['current-set'] = $current_set_size;
  $_SESSION['current-letters'] = $letters;
  $_SESSION['ALL_MATH'] = $all_math;
  $_SESSION['resp_errors_trial'] = 0;
  $_SESSION['speed_errors_trial'] = 0;

  # move to math problem
  header("Location: http://cognitivetask.com/aospan/task/math.php");
}
?>