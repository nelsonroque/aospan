<?php
# create session to transfer vars
session_start();

# max_trials in task
$max_trials = $_SESSION['max_trials'];
$_SESSION['presentation'] = 0;

# generate set size
function gen_set () {
  # get list of sets
  $all_sets = array(2);

  # shuffle it
  shuffle($all_sets);

  # pop current set
  $set_size = array_pop($all_sets);

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
  $problems = array ( "(4*4)", "(2*8)", "(9*2)", "(6*3)", "(3*6)", "(2*9)", "(5*4)", "(4*5)", 
                      "(7*3)", "(3*7)", "(8*3)", "(6*4)", "(4*6)", "(3*8)", "(5*5)", "(9*3)",
                      "(3*9)", "(7*4)", "(4*7)", "(6*5)", "(5*6)", "(8*4)", "(4*8)", "(7*5)", 
                      "(5*7)", "(9*4)", "(6*6)", "(4*9)", "(8*5)", "(5*8)", "(7*6)", "(6*7)",
                      "(9*5)", "(5*9)", "(8*6)", "(6*8)", "(7*7)", "(9*6)", "(6*9)", "(8*7)",
                      "(7*8)", "(9*7)", "(7*9)", "(8*8)", "(9*8)", "(8*9)", "(9*9)","(1/1)", 
                      "(2/1)", "(2/2)", "(3/1)", "(3/3)", "(4/1)", "(4/2)", "(4/4)", "(5/1)",
                      "(5/5)", "(6/1)", "(6/2)", "(6/3)", "(6/6)", "(7/1)", "(7/7)","(8/1)",
                      "(8/2)", "(8/4)", "(8/8)", "(9/1)", "(9/3)", "(9/9)", "(1*2)",
                      "(1*3)", "(2*2)", "(1*4)", "(1*5)", "(3*2)", "(2*3)", "(1*6)", "(1*7)", 
                      "(4*2)", "(2*4)", "(1*8)", "(3*3)", "(1*9)", "(5*2)", "(2*5)", "(6*2)", 
                      "(4*3)", "(3*4)", "(2*6)", "(7*2)", "(2*7)", "(5*3)", "(3*5)", "(8*2)");
  $numbers = array('1','2','3','4','5','6','7','8','9');
  $sign = array('+','-');
  $given_answer = array("R","FP","FN");

  $answer = -1;

  # shuffle elements for trial
  shuffle($problems);
  shuffle($numbers);
  shuffle($sign);
  shuffle($given_answer);

  while ($answer <= 0) {
    # get current trial elements
    $current_problem = array_pop($problems);
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
      shuffle($numbers);
      if ($this_answer == "FP") {
        $given_answer2 = $answer + array_pop($numbers);
      }
      elseif ($this_answer == "FN") {
        $given_answer2 = $answer - array_pop($numbers);
      }
    }

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
if ($_SESSION['trial'] >= $max_trials) {
  $_SESSION['resp_errors_total'] = 0;
  $_SESSION['speed_errors_total'] = 0;
  $_SESSION['presentation_count'] = 1;

  header("Location: http://cognitivetask.com/aospan/task/index.php");
}
else {
  # generate set size
  $current_set_size = gen_set();

  # generate letters
  $letters = gen_letters($current_set_size);

  $all_math = gen_all_math($current_set_size);

  # Create all session variables
  $_SESSION['current-set'] = $current_set_size;
  $_SESSION['current-letters'] = $letters;
  $_SESSION['ALL_MATH'] = $all_math;
  $_SESSION['resp_errors_trial'] = 0;
  $_SESSION['speed_errors_trial'] = 0;

  # move to math problem
  header("Location: http://cognitivetask.com/aospan/practice/mix/math.php");
}
?>