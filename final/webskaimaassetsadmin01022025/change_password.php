<?php

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Database Connection
include('../rvm-include/config.php');

$config = require __DIR__ . '/../rvm-include/sfa_config.php';

$db = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$username = $userinfo['username'];
$useremail = $userinfo['email'];
$clientname = $userinfo['clientname'];


// Generate a new random password
function generateSecurePassword($length = 12)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#%^&*()-_=+[]{}|;:,.<>?'; // Excludes $
    $password = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, $max)];
    }
    return $password;
}
$new_password = generateSecurePassword();

// Hash the password securely using bcrypt
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Check if user exists
$user_check = $con->query("SELECT * FROM admin WHERE username = '$username'");
if ($user_check->num_rows == 0) {
    die("Error: Admin user not found.");
}

// Prepare and execute SQL statement
$sql = "UPDATE admin SET smpassword = ? WHERE username = '$username'";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $con->error); // Debugging SQL errors
}

$stmt->bind_param("s", $hashed_password);
if ($stmt->execute()) {
    echo "Password updated successfully.\n Password is=".$new_password."  ";
    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = $config['smtp']['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp']['username'];
        $mail->Password   = $config['smtp']['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $config['smtp']['port'];

        // Email settings
        $mail->setFrom($config['smtp']['from_email'], $config['rvuserinfo']['websitename'], 'Admin');
        $mail->addAddress($useremail); // Replace with recipient email
        $mail->Subject = 'Your New Admin Password for website';
        $mail->Body    = "Your website " . $clientname  .  " new admin password is : $new_password\n\nPlease change it after login.";

        // Send email
        $mail->send();
        echo "Password email sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send email. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error updating password: " . $con->error;
}

$stmt->close();
$con->close();
