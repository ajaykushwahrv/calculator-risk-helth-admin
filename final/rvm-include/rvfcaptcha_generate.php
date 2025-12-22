<?php 
session_start();

function generateCaptcha($key){
    $rvfa = rand(10,30);
    $rvfb = rand(10,30);
 

    $_SESSION[$key.'_a']   = $rvfa;
    $_SESSION[$key.'_b']   = $rvfb;
    $_SESSION[$key.'_ans'] = $rvfa + $rvfb;

    return $rvfa . " + " . $rvfb;
}
 
?>