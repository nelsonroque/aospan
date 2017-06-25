<?php
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

	echo $rand_string;
	return $rand_string;
}

$digits = 12;
$random_string = gen_random_string($digits);
?>