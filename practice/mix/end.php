<?php
$_SESSION['trial'] = 0;
?>
<html>
<head>
<title>End of Task - OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
  	<div id="instruct_area">
  		<h1>Thank You!</h1>
  		<button>Start Experiment</button>
  	</div>
</div>
</body>
<script>
	function start_exp () {
		window.location.replace('http://cognitivetask.com/aospan/practice/mix/index.php');
	}
</script>
</html>