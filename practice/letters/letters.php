<?php
# create session to transfer set size and current letters 
# all the way to the feedback screen
session_start();

# max_trials
$max_trials = $_SESSION['max_trials'];

if ($_SESSION['trial'] >= $max_trials) {
  header("Location: http://cognitivetask.com/aospan/practice/letters/end.php");
}
else {
  # all possible trial elements
  $all_letters = $_SESSION['remaining-letters'];
  $all_sets = $_SESSION['remaining-sets'];

  # get current trial elements
  $current_set_size = array_pop($all_sets);
  $letters = array_splice($all_letters,0,$current_set_size);
  $letters = implode("", $letters);
  $_SESSION['trial'] += 1;
  $_SESSION['current-set'] = $current_set_size;
  $_SESSION['current-letters'] = $letters;
  $_SESSION['remaining-letters'] = $all_letters;
  $_SESSION['remaining-sets'] = $all_sets;
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
  </div>
</div>
</body>
<script>
/* functions */
/* =======================================*/
function debugMe () {
  document.write("DEBUGGING MODE", "<br>");
  document.write("set size: ", current_set, "<br>");
  document.write("string length: ", letters.length, "<br>");
  document.write("trial letters: ", letters, "<br>");
}
/* =======================================*/
function reverse(s){
  s = s.split("").reverse().join("");
  return s.trim();
}
/* =======================================*/
function showResponseScreen () {
  window.location.replace("http://cognitivetask.com/aospan/practice/letters/response.php");
}
/* =======================================*/
function trial_dynamic(current_set) {

  if (current_set == 2) {
    var current_set_edit = current_set - 1;
    var set_size = current_set;
  }
  else {
    var current_set_edit = current_set - 1;
    var set_size = current_set;
  }

  var mytimeout = (800*set_size)+1000;

  (function displayLetters (i) {
      setInterval(function () {
        var current_letter = letters[i];

        /* remove undefined from displaying in mask */
        if (current_letter === undefined) {
          current_letter = '';
        }

        /* display letter */
        document.getElementById("letters").innerHTML = current_letter;
        
        /* self-referencing function */
        if (--i) {                // If i > 0, keep going
          displayLetters(i);      // Call the loop again, and pass it the current value of i
        }}, 800);
      })(current_set_edit);
  setTimeout(function() {
    showResponseScreen();
  },mytimeout);
}
/* =======================================*/
var current_set = <?php echo($_SESSION['current-set']); ?>;
var all_letters = (Array(<?php echo json_encode($_SESSION['current-letters']); ?>));
var letters = String(all_letters).replace(/\W/g, ''); /* remove all non alpha chars */
letters = letters.replace(/\s+/g, ''); /* remove all whitespace */
letters = reverse(letters);
trial_dynamic(current_set);
</script>
</html>