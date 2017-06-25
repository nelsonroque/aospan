<?php
# create session to transfer set size and current letters 
# all the way to the feedback screen
session_start();

# max_trials in version
$max_trials = $_SESSION['max_trials'];

if ($_SESSION['trial'] >= $max_trials) {
  header("Location: http://cognitivetask.com/aospan/practice/math/end.php");
}
else {
  # all possible trial elements
  $problems = $_SESSION['all-probs'];
  $numbers = $_SESSION['all-nums'];
  $sign = $_SESSION['all-signs'];
  $given_answer = $_SESSION['all-ans'];

  $answer = -1;

  while ($answer <= 0) {

  # get current trial elements
  $current_problem = array_shift($problems);
  $current_num = array_shift($numbers);
  $current_sign = array_shift($sign);
  $this_answer = array_shift($given_answer);

  $current_sign1 = $current_problem[2];
  $current_num1 = $current_problem[1];
  $current_num2 = $current_problem[3];

  switch($current_sign1) {
    case '/':
      $answer = $current_num1 / $current_num2;
      break;
    case '*':
      $answer = $current_num1 * $current_num2;
      break;
    default:
      $answer = "1symbol error -- check array";
      break;
  }

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
  }

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

  $_SESSION['trial'] += 1;
  $_SESSION['current-math'] = $current_problem.$current_sign.$current_num;
  $_SESSION['correct-response'] = $answer;
  $_SESSION['given-response'] = $this_answer;
  $_SESSION['difficulty'] = $difficulty;

  $_SESSION['all-probs'] = $problems;
  $_SESSION['all-nums'] = $numbers;
  $_SESSION['all-signs'] = $sign;
  $_SESSION['all-ans'] = $given_answer;
}
?>
<html>
<head>
<title>Trial <?php echo($_SESSION['trial']." of ".$_SESSION['max_trials']); ?> - OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  <div id="canvas_area">
    <div id="letters">
    </div>
    <div id="row">
      <div id="advance_area">
        <form action="save_RT.php" method="post">
          <input id="myRT" type="hidden" name="reaction_time">
          <input id="function_button" type="submit" onclick="advanceScreen(start_time)" value="RESPOND">
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<script>
/* =======================================*/
/* ============== FUNCTIONS ============= */
/* =======================================*/
/* start timer */
var d_s = new Date(); 
var start_time = d_s.getTime();

function advanceScreen(start_time) {
  var d_e = new Date(); 
  var end_time = d_e.getTime();
  var RT = (end_time - start_time)/1000;
  document.getElementById("myRT").value = RT;
}

function trial() {
  var math_problem = "<?php echo($_SESSION['current-math']); ?>" + " = ?";
  document.getElementById("letters").innerHTML = math_problem;
}
/* =======================================*/
trial();
</script>
</html>