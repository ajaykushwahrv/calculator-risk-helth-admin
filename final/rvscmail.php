 
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Security-Policy: script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com;");

session_start();
include("./rvm-include/config.php");


require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/Exception.php';

$config = require __DIR__ . '/rvm-include/sfa_config.php';

$db = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['pass']);

use PHPMailer\PHPMailer\PHPMailer;


 
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // In case of multiple IPs (proxy), first IP is real client
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    }

    return $_SERVER['REMOTE_ADDR'];
}

$ip = getClientIP();

// ---------------- MATH CAPTCHA VERIFY ----------------
 
// When form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // Captcha validation
    if($_POST['contact_captcha'] != $_SESSION['contact_ans']){
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?err=captcha_err");
        exit;
    }  else {
    $captcha_valid = true;

// Script Injection Block
 foreach ($_POST as $value) {
    if (stripos($value, "<script") !== false) {
        die("Script injection blocked!");
    }
}


// CSRF Check
if (!isset($_POST['rvrrf']) || $_POST['rvrrf'] !== $_SESSION['rvrrf']) {
die("Invalid request - RSCSRF failed");
}

  // Honeypot Bot Check
if (!empty($_POST['my_address'])) {
die("Bot detected!");
}

// ---------------- READ FORM INPUTS ----------------
$cfusersName = trim($_POST['rvusersName']);
$cfuserEmail = filter_var(trim($_POST['rvruserEmail']), FILTER_VALIDATE_EMAIL);
$cfmobile = trim($_POST['rvrmobile']);
$cfservices = trim($_POST['cfservices']);
$cfmessage = trim($_POST['rvrmessage']);
$cfformtype =  trim($_POST['rvrformtype']);

 
if (!$cfuserEmail) { die("Invalid Email"); }
if (!preg_match("/^[6-9]\d{9}$/", $cfmobile)) { die("Invalid Mobile"); }


if (!isset($cfuserEmail) || !filter_var($cfuserEmail, FILTER_VALIDATE_EMAIL)) {
    exit(json_encode(["status" => "error", "msg" => "Invalid Email!"]));
}

$email = filter_var($cfuserEmail, FILTER_SANITIZE_EMAIL);
$ip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    exit(json_encode(["status" => "error", "msg" => "Invalid IP address!"]));
}
 

// ---------------- CHECK 7 DAYS LIMIT ----------------
$stmt = $con->prepare("SELECT created_at  FROM rvrhc_logs  WHERE (email=? OR ip=?)  AND form_lead_name=?  ORDER BY id DESC  LIMIT 1");
$stmt->bind_param("sss", $email, $ip, $cfformtype);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($oldDate);
$stmt->fetch();

if ($stmt->num_rows > 0) {  // SAME FORM FOUND BEFORE

    // LAST SUBMIT DATE + 7 DAYS
    $unlockTime = strtotime($oldDate . " +7 days");
    $now = time();
    $remaining = $unlockTime - $now;  // Seconds remaining

    if ($remaining > 0) {

        // Calculate Days / Hours / Minutes / Seconds
        $_SESSION['rem_seconds'] = $remaining;

        $_SESSION['withindaysemsg'] = "You cannot submit this form again within 7 days.";

        header("Location: rvrhc-thankyou.php");
        exit;
    }
}

$stmt->close();

 

// ---------------- RATE LIMIT (2 minutes) ----------------
$limitTime = date("Y-m-d", time() - 120); // last 2 minutes
$stmt = $con->prepare("SELECT COUNT(*) FROM rvrhc_logs WHERE ip=? AND created_at > ?");
$stmt->bind_param("ss", $ip, $limitTime);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if ($count >= 3) {
die("Too many attempts. Try again later.");
}

// ---------------- CHECK SAME FORM LEAD NAME ----------------


$stmt = $con->prepare("INSERT INTO rvrhc_logs (ip, email, form_lead_name, created_at) 
                        VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $ip, $cfuserEmail, $cfformtype, $today);
$stmt->execute();
$stmt->close();

  




$mail = new PHPMailer(true);
$adminMail = $config['smtp']['from_email'];;
$body  = "<table width='100%' border='0' cellpadding='3' cellspacing='7' bgcolor='#e4e4e4' style='font-size:12px;'>
<thead>
    <tr><td bgcolor='#FFFFFF' colspan='2'>New Contact Us Inquiry Received from Website</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Name</strong></td><td bgcolor='#FFFFFF'>$cfusersName</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Email</strong></td><td bgcolor='#FFFFFF'>$cfuserEmail</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Mobile</strong></td><td bgcolor='#FFFFFF'>$cfmobile</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Service</strong></td><td bgcolor='#FFFFFF'>$cfservices</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Message</strong></td><td bgcolor='#FFFFFF'>$cfmessage</td></tr>
</thead>
</table>";

try {
$mail->isSMTP();
$mail->Host = $config['smtp']['host'];
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Port =  $config['smtp']['port'];

$mail->Username = $config['smtp']['username'];
$mail->Password = $config['smtp']['password'];

$mail->setFrom($config['smtp']['from_email'], $config['smtp']['from_name']);
$mail->addAddress($adminMail);
$mail->isHTML(true);
$mail->Subject = "New Contact Lead - ".$cfusersName;
$mail->Body = $body;

$mail->send();

} catch(Exception $e) {
die("Mail failed: " . $mail->ErrorInfo);
}

// Save lead to DB
insertLeads($con, $cfusersName, $cfmobile, $cfuserEmail, $cfservices, $cfmessage, $cfformtype);


$_SESSION['rvrhName'] = $cfformtype;
$_SESSION['rvrhprofilemsg'] = "Thank you for contacting us. We will get back to you shortly.";

 header("Location: rvrhc-thankyou.php");
 

exit;
}
}
$_SESSION['rvrrf'] = bin2hex(random_bytes(32));
?>


 