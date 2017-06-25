<?php
# open session to transfer vars
session_start();
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
function reverse(s){
    return s.split("").reverse().join("");
}
/* =======================================*/
function continueScreen () {
  window.location.replace("http://cognitivetask.com/aospan/practice/mix/check_pres.php");
}
/* =======================================*/
function trial_dynamic(pres,current_set,all_letters) {
  letters = reverse(all_letters);
  var current_letter = all_letters[pres];
  setTimeout(function () {
    document.getElementById("letters").innerHTML = current_letter;
  },800);
  setTimeout(function () {
    continueScreen();
  },1800);
}
/* =======================================*/
var current_set = <?php echo($_SESSION['current-set']); ?>;
var pres = <?php echo($_SESSION['presentation']); ?>;
var all_letters = <?php echo json_encode($_SESSION['current-letters']); ?>;

trial_dynamic(pres,current_set,all_letters);
</script>
</html>