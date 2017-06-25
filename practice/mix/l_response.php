<?php
session_start();
?>
<html>
<head>
<title>Response Screen - OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
<div id="instruct_area">
  Respond below by clicking letters
  <div id="response_area">
    <div id="row">
      <div id="col3">
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="F">F</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="K">K</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="P">P</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="S">S</button><br>
        <button id="function_button" onclick="clearArray()">CLEAR</button>
      </div>
      <div id="col3">
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="H">H</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="L">L</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="Q">Q</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="T">T</button><br>
        <button id="function_button" onclick="getClicked(clicked_array,this.value)" value="-">BLANK</button>
        <div id="buttons_clicked"></div>
      </div>
      <div id="col3">
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="J">J</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="N">N</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="R">R</button><br>
        <button id="ltr_response_button" onclick="getClicked(clicked_array,this.value)" value="Y">Y</button><br>
        <form action="save_trial.php" method="post">
          <input id="allclicks" type="hidden" name="clicky">
          <input id="done_button" type="submit" value="DONE">
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>
<script>
var clicked_array = Array();
/* =======================================*/
function getClicked (clicked_array,current_id) {
  clicked_array.push(current_id);
  var clickedLetters = String(clicked_array).replace(/,/g, '');
  document.getElementById("buttons_clicked").innerHTML = clickedLetters;
  document.getElementById("allclicks").value = clickedLetters;
}
/* =======================================*/
function clearArray () {
  clicked_array = new Array();
  var clickedLetters = String(clicked_array).replace(/,/g, '');
  document.getElementById("buttons_clicked").innerHTML = clickedLetters;
  document.getElementById("allclicks").value = clickedLetters;
  return clicked_array;
}
/* =======================================*/
</script>
</html>