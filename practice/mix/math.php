<?php
# create session to transfer set size and current letters 
# all the way to the feedback screen
session_start();

# get list of all math problems
$math_data = $_SESSION['ALL_MATH'][$_SESSION['presentation']];

# get individual elements from math array
$current_problem = $math_data[0];
$current_sign = $math_data[1];
$current_num = $math_data[2];
$difficulty = $math_data[3];
$answer = $math_data[4];
$this_answer = $math_data[5];

# save all to session for data writing
$_SESSION['current-math'] = $current_problem.$current_sign.$current_num;
$_SESSION['difficulty'] = $difficulty;
$_SESSION['correct-answer'] = $answer;
$_SESSION['given-response'] = $this_answer;
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
var user_timeout = "<?php echo($_SESSION['timeout']); ?>";
var math_problem = "<?php echo($_SESSION['current-math']); ?>" + " = ?";

/* advance to next screen */
function advanceScreen(start_time) {
  var d_e = new Date(); 
  var end_time = d_e.getTime();
  var RT = (end_time - start_time)/1000;
  document.getElementById("myRT").value = RT;
}

/* draw one trial of math */
function trial(math_problem,user_timeout) {
  document.getElementById("letters").innerHTML = math_problem;
  setTimeout(function() {
    window.location.replace('http://cognitivetask.com/aospan/practice/mix/save_RT.php');
  },user_timeout);
}
/* =======================================*/
trial(math_problem,user_timeout);
</script>
</html>