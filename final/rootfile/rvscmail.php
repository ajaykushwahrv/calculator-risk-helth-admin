 
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

 
	
	$formVal = $_POST['form_val'] ?? '';
	$formKeyName = $formVal . 'form_key';
	$formKey = ($_POST[$formKeyName] ?? '');
    $captchaField = $formKey .'_'. $formVal . '_captcha';
	$rvrrf = $formVal . 'rvrrf';	
	$honeypot = $formVal . '_hp_' . $formKey;
	$captchacode = $formKey . '_' . $formVal . '_ans';
 
   // Captcha validation
    if($_POST[$captchaField] != ($_SESSION[$captchacode] ?? '')){
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


// RSCSRF Check

if (empty($_SESSION[$rvrrf][$formKey]) ||  $_POST[$rvrrf] !== $_SESSION[$rvrrf][$formKey]
) {
  die("Invalid request - RSCSRF failed");
}		
		
 	
		
  // Honeypot Bot Check
if (!empty($_POST[$honeypot])) {
    die("Bot detected");
}
// ---------------- READ FORM INPUTS ----------------
		
		
	$rvusersName = $formVal . '_rvusersName';
 	$rvruserEmail = $formVal . '_rvruserEmail';
 	$rvrmobile = $formVal . '_rvrmobile';
 	$rvrmessage = $formVal . '_rvrmessage';
 	$cfservices = $formVal . '_cfservices';
 	$rvrformtype = $formVal . '_rvrformtype';
 	$rvrformname = $formVal . '_rvrformname';
	$cfusersName = trim($_POST[$rvusersName]);
	$cfuserEmail = filter_var(trim($_POST[$rvruserEmail]), FILTER_VALIDATE_EMAIL);
	$cfmobile = trim($_POST[$rvrmobile]);
	$cfservices = trim($_POST[$cfservices]);
	$cfmessage = trim($_POST[$rvrmessage]);
	$cfformtype =  trim($_POST[$rvrformtype]);
	$cfformtypename =  trim($_POST[$rvrformname]);		
		
		


 
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
$adminMail = $config['smtp']['from_email'];
$ccMail = $config['smtp']['CC_email'];
$bccMail = $config['smtp']['BCC_email'];
$body  = "<table width='100%' border='0' cellpadding='3' cellspacing='7' bgcolor='#e4e4e4' style='font-size:12px;'>
<thead>
    <tr><td bgcolor='#FFFFFF' colspan='2'>$cfformtypename</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Name</strong></td><td bgcolor='#FFFFFF'>$cfusersName</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Email</strong></td><td bgcolor='#FFFFFF'>$cfuserEmail</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Mobile</strong></td><td bgcolor='#FFFFFF'>$cfmobile</td></tr>";
if (!empty($cfservices)) {
    $body .= "<tr>
        <td bgcolor='#FFFFFF'><strong>Service</strong></td>
        <td bgcolor='#FFFFFF'>" . htmlspecialchars($cfservices) . "</td>
    </tr>";
}
if (!empty($cfmessage)) {
    $body .= "<tr>
        <td bgcolor='#FFFFFF'><strong>Message</strong></td>
        <td bgcolor='#FFFFFF'>" . htmlspecialchars($cfmessage) . "</td>
    </tr>";
}
$body .= "</thead> </table>";


try {
$mail->isSMTP();
$mail->Host = $config['smtp']['host'];
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Port =  $config['smtp']['port'];

$mail->Username = $config['smtp']['username'];
$mail->Password = $config['smtp']['password'];

$mail->setFrom($config['smtp']['from_email'], $config['rvuserinfo']['websitename']);
$mail->addAddress($adminMail);
if (!empty($ccMail)) { $mail->addCC($ccMail); }
if (!empty($bccMail)) { $mail->addBCC($bccMail); }
$mail->isHTML(true);
$mail->Subject = "New Contact Lead - ".$cfusersName;
$mail->Body = $body;

$mail->send();

} catch(Exception $e) {
die("Mail failed: " . $mail->ErrorInfo);
}

// Save lead to DB
insertLeads($con, $cfusersName, $cfmobile, $cfuserEmail, $cfservices, $cfmessage, $cfformtype);
// CSRF
unset($_SESSION[$rvrrf][$formKey]);
// Captcha
unset($_SESSION[$formKey . '_' . $formVal . '_ans']);

$_SESSION['rvrhName'] = $cfformtype;
$_SESSION['rvrhprofilemsg'] = "Thank you for contacting us. We will get back to you shortly.";

 header("Location: rvrhc-thankyou.php");
 

exit;
}
}

?>


 