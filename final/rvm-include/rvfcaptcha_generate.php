<?php 
	session_start();
	// Random numbers
	$rvfa = rand(10,50);
	$rvfb = rand(10,50);
	$_SESSION['rvfcaptcha_answer'] = $rvfa + $rvfb;
	echo $rvfa . " + " . $rvfb;
?>