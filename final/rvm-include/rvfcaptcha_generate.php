<?php
  
function handleCaptcha($key) {
    $a = rand(10, 30);
    $b = rand(10, 30);

    $_SESSION[$key . '_a']   = $a;
    $_SESSION[$key . '_b']   = $b;
    $_SESSION[$key . '_ans'] = $a + $b;

    return $a . " + " . $b;
}

/* -------- REQUEST HANDLE -------- */

// AJAX refresh request
if (isset($_GET['refresh']) && isset($_GET['key'])) {
    echo handleCaptcha($_GET['key']);
    exit;
}

// Normal page load generate
if (isset($_GET['key'])) {
    $captcha = handleCaptcha($_GET['key']);
}
?>