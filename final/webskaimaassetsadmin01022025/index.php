<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 

ob_start();
require("../rvm-include/config.php");

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Otp | <?= $config['rvuserinfo']['websitename']; ?></title>
		<link href="./rvlogin.css" rel="stylesheet">
		<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
		<script src="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
	</head>

	<body>
<?php

 

		
session_start();

if (isset($_POST['submit'])) {
	$uname = mysqli_real_escape_string($con, $_POST['username']);
	$pass = mysqli_real_escape_string($con, $_POST['smpassword']);

	date_default_timezone_set("Asia/Kolkata");
	$timestamp = date('Y-m-d H:i:s');

	// Fetch stored hashed password & status
	$sql = "SELECT id, smtpemail, smpassword, status FROM admin WHERE username = ?";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows === 1) {
		$row = $result->fetch_assoc();
		$stored_hashed_password = $row['smpassword'];
		$status = $row['status'];
		$email = $row['smtpemail'];

		//  Step 1: Verify password
		if (password_verify($pass, $stored_hashed_password)) {
			if ($status == '1') {
				//  Step 2: Store temporary session
					session_start();
					 $_SESSION['smtpemail'] = 	$email;  

				//  Step 3: Redirect to send_otp.php (for email OTP)
				header("Location: ./send_otp.php");
				
				//header("Location: ../rvfaotp/send_otp.php");
				exit();
			} else {
				$msg = '<div class="alert alert-danger">Your Login is Disabled. Please Contact Administrator.</div>';
			}
		} else {
			$msg = '<div class="alert alert-danger">Invalid username or password!</div>';
		}
	} else {
		$msg = '<div class="alert alert-danger">Invalid username or password!</div>';
	}

	$stmt->close();
}
?>

 
		<section class="rvlogin-section">
			
				<div class="rv-card">
					<div class="rv-card-body">
						<div class="rv-hadding">
							<h1 class="text-primary">Welcome To Admin</h1>
							<h3><?= $config['rvuserinfo']['websitename']; ?></h3>
						</div>

						<div class="p-2 mt-4">
							<?php if (isset($msg)) echo $msg; ?>

							<form method="post" onsubmit="return valid();">
								<div class="form-group">
									<label for="username" class="form-label">Username</label>
									<input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
								</div>
								<div class="form-group">
									<label for="password" class="form-label">Password</label>
									<input type="password" class="form-control" name="smpassword" id="password" placeholder="Enter password">
									<span class="toggle-password"><i class="bi bi-eye-fill fa-fw"></i></span>
								</div>
								<div class="form-group">
									<button class="btn btn-primary w-100 btn-lg" name="submit" type="submit">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		 
		</section>

		<script>
			function valid() {
				let u = document.getElementById('username').value.trim();
				let p = document.getElementById('smpassword').value.trim();
				if (!u || !p) { alert("Please fill all fields"); return false; }
				return true;
			}
			
			
			
			    
    
    jQuery(document).ready(function() {
        jQuery('.toggle-password').click(function() {
            var passwordField = jQuery('#password');
            var fieldType = passwordField.attr('type');
            jQuery(this).toggleClass('show');


            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
            } else {
                passwordField.attr('type', 'password');
            }
        });
    });
		</script>

	</body>
</html>
