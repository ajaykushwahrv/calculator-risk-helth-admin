<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$config = require __DIR__ . '/../rvm-include/sfa_config.php';

try {
    $db = new PDO(
        $config['db']['dsn'],
        $config['db']['user'],
        $config['db']['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if (!empty($_SESSION['admin_login'])) {

        $email = $_SESSION['admin_login'];

        $stmt = $db->prepare("DELETE FROM otp_codes WHERE email = :email");
        $stmt->execute([':email' => $email]);

        echo "OTP records deleted for: $email <br>";

    } else {
        echo " Session email not found: ";
 
		header("Location: ../index.php");
        exit;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

session_unset();
session_destroy();

header("Location: ../index.php");
exit;
?>
