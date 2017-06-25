<?php
#session_destroy();
session_start();
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
} 

function gen_random_string($digits) {
	# list of all numbers and letters
	$all_nums = array('0','1','2','3','4','5','6','7','8','9');
	$all_letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	$rand_string = '';

	# Shuffle both lists
	shuffle($all_nums);
	shuffle($all_letters);

	$i = 0;

	while ($i < $digits) {
		if ($i % 2 == 0) {
			$cur_rand = array_pop($all_nums);
		}
		else {
			$cur_rand = array_pop($all_letters);
		}

		$rand_string = "$rand_string"."$cur_rand";
		$i += 1;
	}

	return $rand_string;
}


# ===============================================================================
# GET URL PARAMETERS
# ===============================================================================

# if study name given, check if data folder exists, if doesn't create it, if does, set as foldername
if(isset($_GET['study']) && !empty($_GET['study'])) {
    $_SESSION['study'] = $_GET['study'];
} else {
    $_SESSION['study'] = "AOSPAN";
}

# if study name given, check if data folder exists, if doesn't create it, if does, set as foldername
if(isset($_GET['end_URL']) && !empty($_GET['end_URL'])) {
    $_SESSION['CUSTOM_URL'] = 1;
    $_SESSION['final_URL'] = $_GET['end_URL'];
} else {
    $_SESSION['CUSTOM_URL'] = 0;
    $_SESSION['final_URL'] = "";
}

# get worker ID from url var
if(isset($_GET['MID']) && !empty($_GET['MID'])){
    $WORKER_ID = $_GET['MID'];
} else {
    $WORKER_ID = "NO_WORKER_ID";
}

# for debugging
#echo $_SESSION['final_URL'];
#echo $_SESSION['study'];
# ===============================================================================
# GENERATE SESSION ID
# ===============================================================================

# generate participant code
$digits = 16;
$random_string = gen_random_string($digits);

# ===============================================================================
# SAVE SESSION VARS
# ===============================================================================

# set participant info
$_SESSION['trial'] = 0;
$_SESSION['presentation_count'] = 0;
$_SESSION['workerID'] = $WORKER_ID;
$_SESSION['part_id'] = "$random_string";
$_SESSION['date'] = date("m.d.y");
$_SESSION['time'] = date("h:i:sa");

# get browser info
$ua=getBrowser();
$_SESSION['b_name'] = $ua['name'];
$_SESSION['b_ver'] = $ua['version'];
$_SESSION['b_plt'] = $ua['platform'];
$_SESSION['b_UA'] = $ua['userAgent'];


# ===============================================================================
# OPEN DATASET
# ===============================================================================

$_SESSION['study_data_path'] = "data/" . $_SESSION['study'] . "/";
$_SESSION['practice_data_path'] = $_SESSION['study_data_path']. "practice". "/";
$_SESSION['letter_data_path'] = $_SESSION['practice_data_path'] . "letters". "/";
$_SESSION['math_data_path'] = $_SESSION['practice_data_path']. "math". "/";
$_SESSION['mix_data_path'] = $_SESSION['practice_data_path']. "mix". "/";
$_SESSION['task_data_path'] = $_SESSION['study_data_path'] . "task". "/";

if (!file_exists($_SESSION['study_data_path'])) {
    mkdir($_SESSION['study_data_path'], 0777);
    mkdir($_SESSION['practice_data_path'], 0777);
    mkdir($_SESSION['letter_data_path'], 0777);
    mkdir($_SESSION['math_data_path'], 0777);
    mkdir($_SESSION['mix_data_path'], 0777);
    mkdir($_SESSION['task_data_path'], 0777);
    exit;
}

$file_name = $_SESSION['part_id'].".txt";
$_SESSION['letters_data_filename'] = $_SERVER['DOCUMENT_ROOT']."/aospan/".$_SESSION['letter_data_path'].$file_name;
$_SESSION['math_data_filename'] = $_SERVER['DOCUMENT_ROOT']."/aospan/".$_SESSION['math_data_path'].$file_name;
$_SESSION['mix_data_filename'] = $_SERVER['DOCUMENT_ROOT']."/aospan/".$_SESSION['mix_data_path'].$file_name;
$_SESSION['task_data_filename'] = $_SERVER['DOCUMENT_ROOT']."/aospan/".$_SESSION['task_data_path'].$file_name;


// echo "DEBUGGING<br>-------------------------------------------------<br>";
// echo $_SESSION['letters_data_filename'];
// echo "<br>";
// echo $_SESSION['math_data_filename'];
// echo "<br>";
// echo $_SESSION['mix_data_filename'];
// echo "<br>";
// echo $_SESSION['task_data_filename'];
// echo "<br>";
?>
<html>
<head>
<title>OSPAN</title>
<link rel="stylesheet" type="text/css" href="http://cognitivetask.com/aospan/assets/style.css">
</head>
<body>
<div class="container">
    <div id="instruct_area">
          <hr>
        <h1 class="thick_header">IMPORTANT</h1>
      <div id="current_inst">
      <table>
      <tr>
      <td><h3>DO NOT REFRESH THIS PAGE!</h3></td>
      <td><h3>DO NOT CLICK BACK OR FORWARD!</h3></td>
      <td><h3>DO NOT RESIZE YOUR WINDOW!</h3></td>
      </tr>
      <tr>
        <span style="color:red"><h3>CLOSE ALL OTHER PROGRAMS YOU MAY HAVE OPEN,<br>AS THEY WILL AFFECT PERFORMANCE OF YOUR COMPUTER</h3></span>
      </tr>
      <tr>
        <u><h3>If you do not follow these instructions,<br>we cannot use your data</h3></u>
      </tr>
      </table>
      <hr>
              <h1 class="thick_header">Instructions</h1>
        <p>In this experiment you will try to memorize letters you see on the screen while you also solve simple math problems.
In the next few minutes, you will have some practice to get you familiar with how the experiment works.
We will begin by practicing the letter part of the experiment. When you're ready, click the start button.</p>
          <button class="standard_button_blue" onclick="start_experiment()">START EXPERIMENT</button>
          </div>
    </div>
</div>
</body>
</html>
<script>
function start_experiment () {
    window.location.assign("http://cognitivetask.com/aospan/practice")
}
</script>