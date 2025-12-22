<!DOCTYPE html>
<html lang="en">

<?php
	session_start();
include("./rvm-include/config.php");
header("Content-Security-Policy: script-src 'self' 'unsafe-inline' ".$config['rvuserinfo']['base_url']."; object-src 'none'; base-uri 'self'; frame-ancestors 'none';");



require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/Exception.php';

$config = require __DIR__ . '/rvm-include/sfa_config.php';
$db = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['pass']);

use PHPMailer\PHPMailer\PHPMailer;


function callAPI($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$res = curl_exec($ch);
curl_close($ch);

return json_decode($res, true);
}

// API CALL
$apiURL = "https://redvisionweb.com/api/open-apis/health-questions?apikey=fc1017dad92f3bbbd9cee9bc21d4b0e0";
$riskData = callAPI($apiURL);




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



// ---------------- GOOGLE CAPTCHA VERIFY ----------------
 
 
// When form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if($_POST['health_captcha'] != $_SESSION['health_ans']){
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
$cfservices = 'New Health Insurance Inquiry Received from Website';
$cfmessage = trim($_POST['rvrmessage']);
$cfformtype =  trim($_POST['rvrformtype']);


 // Health FORM ANSWERS
for ($i = 1; $i <= 10; $i++) {
    ${"rvrradio".$i} = intval($_POST["answers".$i]);
}
$rvrhadioadd =   $rvrradio1 + $rvrradio2 + $rvrradio3 + $rvrradio4 + $rvrradio5 + $rvrradio6 + $rvrradio7 + $rvrradio8 + $rvrradio9 + $rvrradio10 ;


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


$stmt = $con->prepare("INSERT INTO rvrhc_logs (ip, email, score, form_lead_name, created_at) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $ip, $cfuserEmail, $rvrhadioadd, $cfformtype, $today);
$stmt->execute();
$stmt->close();
  
 
if ($rvrhadioadd >= 1 && $rvrhadioadd <= 3) {
    $healthprofile = "Critical";
    $healthprofilemsg = "Your financial situation is at a very critical level and you need to get some professional help before its too late. We will soon send you a thorough analysis of your financial health.";
    
}
else if ($rvrhadioadd >= 4 && $rvrhadioadd <= 5) {
    $healthprofile =   "Weak";
    $healthprofilemsg = "Your financial situation is weak. There are certain basic areas that you have taken care of but a majority of them needs to  be worked upon. We will soon send you a thorough analysis of your financial health.";
}
else if ($rvrhadioadd >= 6 && $rvrhadioadd <= 7) {
    $healthprofile =    "Border Line";
    $healthprofilemsg = "We can see that you have put in effort to plan your finances. But at the same time there certain areas that have been completely ignored. A correct direction along with proper risk profiling and asset allocation is what you might need. We will soon send y";
}
else if ($rvrhadioadd >= 8 && $rvrhadioadd <= 9) {
    $healthprofile =   "Fit";
    $healthprofilemsg = "Good care has been taken in planning your financial life. A good asset allocation and portfolio rebalancing may be required. It will show help in maximising returns by minimizing the risk. We will soon send you a thorough analysis of your financial health";
}
else if ($rvrhadioadd >= 10 && $rvrhadioadd <= 10) {
    $healthprofile =   "Excellent ";
    $healthprofilemsg = "We appreciate the effort you've put into financial planning. You are in the correct direction. Make sure you rebalance your portfolio regularly. We will soon send you a thorough analysis of your financial health.";
}
 




$mail = new PHPMailer(true);
$adminMail = $config['smtp']['from_email'];;
$body  = "<table width='100%' border='0' cellpadding='3' cellspacing='7' bgcolor='#e4e4e4' style='font-size:12px;'>
<thead>
    <tr><td bgcolor='#FFFFFF' colspan='2'>$cfservices</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Name</strong></td><td bgcolor='#FFFFFF'>$cfusersName</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Email</strong></td><td bgcolor='#FFFFFF'>$cfuserEmail</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Mobile</strong></td><td bgcolor='#FFFFFF'>$cfmobile</td></tr>
    <tr><td bgcolor='#FFFFFF'><strong>Message</strong></td><td bgcolor='#FFFFFF'>$cfmessage</td></tr>
</thead>
<tbody>
 

    <tr><td  bgcolor='#FFFFFF' colspan='2'><br></td></tr>
    <tr><td  bgcolor='#FFFFFF' colspan='2'> Your Score is " . ($rvrhadioadd * 10) . " out of 100</td></tr>
    <tr><td  bgcolor='#FFFFFF' colspan='2'> $healthprofile </td></tr>
    <tr><td  bgcolor='#FFFFFF' colspan='2'>$healthprofilemsg <br></td></tr>
    <tr><td  bgcolor='#FFFFFF' colspan='2'> <br></td></tr>
    </tbody><tfoot>";

$i = 1;
foreach ($riskData as $riskDitems) {

    // Question row
    $body .= "<tr><td bgcolor='#FFFFFF' colspan='2'><strong>Q.$i </strong>: {$riskDitems['question']}</td></tr>
              <tr><td bgcolor='#FFFFFF' colspan='2'><strong>Answer </strong>: ";

    // Find selected answer
        $radioValue = ${'rvrradio'.$i};

        if ($radioValue == 0) {
            $body .= "No";
        } else if ($radioValue == 1) {
            $body .= "Yes";
        }

    $body .= "</td></tr>";

    $i++;
}

$body .= "</tfoot></table>";

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


$_SESSION['rvrradioALL'] = "Your Score is " . ($rvrhadioadd * 10) . " out of 100";
$_SESSION['rvrhName'] = $cfformtype;
$_SESSION['rvrhprofile'] = $healthprofile;
$_SESSION['rvrhprofilemsg'] = $healthprofilemsg;

 header("Location: rvrhc-thankyou.php");
 

exit;
}
}
$_SESSION['rvrrf'] = bin2hex(random_bytes(32));
include "./rvm-include/rvfcaptcha_generate.php";
$captcha_health = generateCaptcha("health");
?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['rvuserinfo']['websitename']; ?> || Health</title>
    <link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
    <link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">


    <style>

    </style>
</head>

<body>





 
    <!-- 
</?php foreach($riskData as $jsonDitems){ ?>
    </?= $jsonDitems['question']; ?>
    <br>
    <br>
</?php foreach( $jsonDitems['answers'] as $jsonDitems2){ ?>

    </?= $jsonDitems2['text']; ?>
    
    <br>
    {{</?= $jsonDitems2['marks']; ?>}}
    
    <br>
</?php  } ?>
</?php  } ?> -->

    <section class="rvrhsection-section">
        <div class="section-container rvrhsection">
              <div class="logo-images">
                    <img src="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_logo']; ?>" alt="Logo">
                    <h3>Health Form</h3>
				  <?php if(isset($_GET['err']) && $_GET['err']=="captcha_err"){
	echo "<span style='color:red;'>Invalid Captcha. Please resubmit form!</span>";
}?>
                </div>
            <div class="progressBar">
                <ul>
                    <?php $i=1; foreach($riskData as $riskDitems){ ?>
                    <li><a href="#" data-step="<?= $i - 1 ; ?>"
                            class="pSteps step_<?= $i; ?> <?php switch($i){case 1 : echo 'activeStep'; break;}?>"
                            data-tab-id="<?= $i; ?>"><span class="ws-no"><?= $i; ?></span></a></li>
                    <?php $i++; } ?>
                    <li><a href="#" data-step="10" class="pSteps step_11" data-tab-id="11"><span class="ws-no"><i
                                    class="bi bi-clipboard-check"></i></span></a></li>
                    <!-- <li><a href="#" data-step="1" class="pSteps step_2 back-step" data-tab-id="2"><span class="ws-no">2</span><span class="ws-steps">Step 2</span></a></li>
                <li><a href="#" data-step="3" class="pSteps step_4 back-step" data-tab-id="4"><span class="ws-no">4</span><span class="ws-steps">Step 4</span></a></li> -->
                </ul>
            </div>
            <form  id="secureForm" method="POST">
                <div class="wizard-stape-body">
                    <?php $i=1; foreach($riskData as $riskDitems){ ?>
                    <div class="wizard-stape-cart" id="wizard_stape_<?= $i; ?>"
                        <?php switch($i){case 1 : echo 'style="display:block;"'; break;}?>>

                        <div class="content-box">
                            <h3>Q.<?= $i; ?> <?= $riskDitems['question']; ?></h3>
                            <ul>
                                <?php for($j=1; $j<=2; $j++){ ?>
                                <li>
                                    <input type="radio" name="answers<?= $i; ?>" id="question<?= $i; ?><?= $j; ?>"
                                        value="1">
                                    <label class="rvrhradio next-step" data-step="<?= $i; ?>"
                                        for="question<?= $i; ?><?= $j; ?>">
                                        <i class="bi bi-send-check"></i> Yes
                                    </label>
                                </li>
								 <li>
                                    <input type="radio" name="answers<?= $i; ?>" id="question<?= $i; ?>a<?= $j; ?>"
                                        value="0">
                                    <label class="rvrhradio next-step" data-step="<?= $i; ?>"
                                        for="question<?= $i; ?>a<?= $j; ?>">
                                        <i class="bi bi-send-check"></i> No
                                    </label>
                                </li>
                                <?php $j++; } ?>

                            </ul>



                        </div>
                        <div class="back-links">
                            <?php 
                        switch($i) {
                        case 1: echo '<a href="'. $config['rvuserinfo']['base_url'] .'"><i class="bi bi-chevron-left"></i> Back to Home </a>'; break;
                        default: echo '<a href="javascript:void(0);" class="prev_action" data-step="'. $i .'"><i class="bi bi-chevron-left"></i> Back '.  ($i)   .' </a>'; break; 
                        }
                        ?>
                        </div>
                    </div>
                    <?php $i++; } ?>
                    <div class="wizard-stape-cart" id="wizard_stape_11" style="display:none;">
                        <div class="content-box">
                            <h3>Health Form</h3>
                            <input type="hidden" name="rvrrf" value="<?= $_SESSION['rvrrf'] ?>">
                            <input type="hidden" name="my_address" class="honeypot">
                            <input type="hidden" name="rvrformtype" value="Health">

                            <div class="form-group">
                                <label for='rvrname'>Name</label>
                                <input type="text" name="rvusersName" id="rvrname">
                                <span id="rvrname_err" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for='rvrname'>Email</label>
                                <input type="text" name="rvruserEmail" id="rvremail">
                                <span id="rvremail_err" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for='rvrname'>Mobile</label>
                                <input type="text" name="rvrmobile" id="mobile" maxlength="10">
                                <span id="rvrmobile_err" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for='rvrname'>Message</label>
                                <textarea name="rvrmessage" id="rvrmessage"></textarea>
                                <span id="rvrmessage_err" class="error"></span>
                            </div>
                           <div class="form-group">
								<label for='rvrname'>Solve: <b id="cap_health"><?= $captcha_health ?> </b> = ? </label>
								<div class=""> 
									<input type="number" name="health_captcha" id="rvfcaptcha" maxlength="3" required>
									<a href="#!" type="button"  class="btn btn-primary"  onclick="refreshCaptcha('health')" id="refreshCaptcha">↻</a>
								</div>
								 
							</div>
                             
                        </div>
                        <div class="back-links">
                            <a href="javascript:void(0);" class="prev_action" data-step="11"><i
                                    class="bi bi-chevron-left"></i> Back </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </section>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_js']; ?>"></script>
 
</body>

</html>