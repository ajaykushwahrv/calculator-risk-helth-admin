<!doctype html>
<html lang="en">
	<head>
		<?php 	require("../rvm-include/config.php");?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $config['rvuserinfo']['websitename']; ?></title>
		<link href="./rvlogin.css" rel="stylesheet">
		<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
		<script src="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>

	</head>

	<body>
		<section class="rvlogin-section">
			<div class="rv-card">
				<div class="rv-card-body">
					<?php

			 

					require '../PHPMailer-master/src/PHPMailer.php';
					require '../PHPMailer-master/src/SMTP.php';
					require '../PHPMailer-master/src/Exception.php';

					use PHPMailer\PHPMailer\PHPMailer;
					use PHPMailer\PHPMailer\SMTP;
					use PHPMailer\PHPMailer\Exception;


					
					$config = require __DIR__ . '/../rvm-include/sfa_config.php';

					$db = new PDO($config['db']['dsn'], $config['db']['user'], $config['db']['pass'], [
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					]);

					session_start();

					if (!isset($_SESSION['smtpemail'])) {
						echo "Session email not found";
						header("Location: ../index.php");
						exit;
					}

					$email = $_SESSION['smtpemail'];

					if (!$email) { 
						http_response_code(400); 
						echo "Invalid email"; 
						header("Location: ../index.php");
						exit; 
					}

					// Rate limit check
					$now = time();
					$sth = $db->prepare("SELECT COUNT(*) FROM otp_codes WHERE email=:email AND created_at > :since");
					$sth->execute([':email'=>$email, ':since'=>$now - 60]);
					if ($sth->fetchColumn() >= $config['otp']['max_requests_per_minute']) {
						http_response_code(429); 

					?>
					<div class="rv-hadding">
						<h1 class="text-primary">OTP </h1>
						<h3><?php echo "Too many OTP requests. Try later."; 	exit;?></h3>
					</div>
					<?php }

					// Generate OTP
					$otp = random_int(0, pow(10, $config['otp']['length']) - 1);
					$otp = str_pad($otp, $config['otp']['length'], '0', STR_PAD_LEFT);

					// Store OTP
					$hash = password_hash($otp, PASSWORD_DEFAULT);
					$expires = $now + $config['otp']['expiry_seconds'];

					$ins = $db->prepare("INSERT INTO otp_codes (email, otp_hash, created_at, expires_at, ip) VALUES (:email,:hash,:now,:exp,:ip)");
					$ins->execute([
						':email'=>$email, ':hash'=>$hash, ':now'=>$now, ':exp'=>$expires, ':ip'=>$_SERVER['REMOTE_ADDR'] ?? null
					]);

					// Send email
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
					?>


					<div class="rv-hadding">
						<h1 class="text-primary">Send OTP </h1>
						<h3><?= $email ?></h3>
						<span id="otpStatus" style="color:green; margin-top:10px;"></span>
					</div>
					<div class="verify-code">
						<form action="verify_otp.php" method="POST">
							<input type="hidden" name="<?= $config['rvuserinfo']['email']; ?>" value="<?= $config['rvuserinfo']['email']; ?>">

							<div class="form-group">
								<label for="username" class="form-label">Enter OTP:</label>
								<input type="text" name="otp" class="form-control" required maxlength="6">
							</div>
							<div class="form-group text-right" style="margin-top: 20px;">
								<button id="resendBtn" class="btn btn-secondary" disabled>
									Resend OTP <span class="newotp">(<span id="timer">60</span>s)</span>
								</button>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" name="submit" type="submit">Verify</button>
							</div>

						</form>
					</div>



					<?php

						} catch (Exception $e) {
						$db->prepare("DELETE FROM otp_codes WHERE email=:email AND expires_at=:exp")->execute([':email'=>$email, ':exp'=>$expires]);
						http_response_code(500);
						error_log("Mail error: ".$mail->ErrorInfo);
						echo "Failed to send OTP";
					}
					?>

				</div>
			</div>
		</section>

		   
		<script>
			$(document).ready(function () {

				startTimer(); // start 60 sec timer on page load

				function startTimer() {
					let timeLeft = 60;

					$("#resendBtn").prop("disabled", true)
						.html('Resend OTP (<span id="timer">'+timeLeft+'</span>s)');

					let timer = setInterval(function () {
						timeLeft--;
						$("#timer").text(timeLeft);

						if (timeLeft <= 0) {
							clearInterval(timer);
							$("#resendBtn").prop("disabled", false).text("Resend OTP");
						}
					}, 1000);

					return timer;
				}

				//  CLICK → RESEND OTP VIA AJAX (NO PAGE RELOAD)
				$("#resendBtn").click(function (e) {
					e.preventDefault();

					$("#otpStatus").text("Sending...");

					$.ajax({
						url: "send_otp_ajax.php",  // <<-- NEW AJAX handler
						type: "POST",
						data: { email: "<?= $email ?>" },

						success: function (res) {
							$("#otpStatus").css("color","green").text("OTP sent successfully!");

							startTimer(); // restart timer
						},

						error: function () {
							$("#otpStatus").css("color","red").text("Failed to send OTP");
						}
					});

				});

			});
		</script>
	</body>
</html>
