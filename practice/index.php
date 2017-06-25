<?php
session_start();
$_SESSION['trial'] = 0;
$_SESSION['presentation_count'] = 0;
?>
<html>
<head>
<title>OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<h1>Practice: Letters</h1>
      <p>For this practice set, letters will appear on the screen one at a time.<br><br>
<b>Try to remember each letter in the order presented</b>. 
<br><br>
After 2-3 letters have been shown, you will see a screen listing 12 possible letters. Your job is to select each letter in the order presented. To do this, use the mouse to select each letter. The letters you select will appear at the bottom of the screen. When you have selected all the letters, and they are in the correct order, hit the green DONE button at the bottom right of the screen.
<br><br>
If you make a mistake, hit the CLEAR box to start over. If you forget one of the letters, click the BLANK box to mark the spot for the missing letter.
<br><br>
<b>Remember, it is very important to get the letters in the same order as you see them.</b>
<br><br>
If you forget one, use the BLANK box to mark the position. When you're ready, click the mouse button to start the letter practice.<br>When you're ready, click the start button.
</p>
<hr>
  	</div>
    <div id="form_area">
	    <form action="letters/start_exp.php" method="post">
        <input id="win-width" type="hidden" name="win_width">
        <input id="win-height" type="hidden" name="win_height">
		    <input class="standard_button_blue" type="submit" onclick="getResolution()" value="START">
	    </form>
    </div>
</div>
</body>
</html>
<script>
function getResolution () {
  var width = screen.width;
  var height = screen.height;
  document.getElementById('win-width').value = width;
  document.getElementById('win-height').value = height;
}
</script>