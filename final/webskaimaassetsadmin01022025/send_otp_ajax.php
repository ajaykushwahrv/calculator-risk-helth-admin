<?php
require("../rvm-include/config.php");
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$config = require __DIR__ . '/../rvm-include/sfa_config.php';
$db = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['pass']);

$email = $_POST['email'] ?? '';

if (!$email) {
    http_response_code(400);
    echo "Email missing";
    exit;
}

$otp = rand(100000, 999999);
$hash = password_hash($otp, PASSWORD_DEFAULT);
$now = time();
$expires = $now + 300;

// Insert OTP
$stmt = $db->prepare("INSERT INTO otp_codes (email, otp_hash, created_at, expires_at) VALUES (:e,:h,:c,:x)");
$stmt->execute([':e'=>$email,':h'=>$hash,':c'=>$now,':x'=>$expires]);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $config['smtp']['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp']['username'];
    $mail->Password = $config['smtp']['password'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = $config['smtp']['port'];

    $mail->setFrom($config['smtp']['from_email'], $config['rvuserinfo']['websitename']);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Your verification code';
    $mail->Body = "<p>Your verification code is <strong>$otp</strong>. It will expire in ".($config['otp']['expiry_seconds']/60)." minutes.</p>";

    $mail->send();

    echo "OK";

} catch (Exception $e) {
    http_response_code(500);
    echo "Mail error";
}
?>