<!DOCTYPE html>
<html lang="en">

	<?php
	session_start();
	include("./rvm-include/config.php");
	?>



	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $config['rvuserinfo']['websitename']; ?> || Tahnk You</title>
		<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
		<link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?>/<?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">


		<style>

		</style>
	</head>

	<body>



		<section class="rvrhsection-section rvrhc-tahnkyou-section">
			<div class="rvrhsection-thank">

				<div class="result-card">
					<div class="image">
						<img src="<?= $config['rvuserinfo']['base_url']; ?>/rvm-include/thank-you-page.svg" alt="Tahnk You">
					</div>
					<div class="result-card-body">
						<h1><i>Thank You</i></h1>

						<?php if (isset($_SESSION['rvrradioALL']) || isset($_SESSION['withindaysemsg'])) { ?>

						<?php if (isset($_SESSION['rvrradioALL'])) { ?>
							<h3><?= $_SESSION['rvrradioALL']; ?></h3>
							<h4>Your <?= $_SESSION['rvrhName']; ?> Profile: <?= $_SESSION['rvrhprofile']; ?></h4>
							<p><?= $_SESSION['rvrhprofilemsg']; ?></p>

							<?php
							unset($_SESSION['rvrradioALL']);
							unset($_SESSION['rvrhprofile']);       // corrected
							unset($_SESSION['rvrhprofilemsg']);    // corrected
							?>
						<?php } ?>

						<?php if(isset($_SESSION['withindaysemsg'])): ?>
							<div style="color:red; font-size:18px; padding:15px;">
								<?= $_SESSION['withindaysemsg']; ?>
								<br><br>
								<b>Try again after:</b> 
								<span id="countdown"></span>
							</div>
						<?php endif; ?>
						<script>
						let remaining = <?= $_SESSION['rem_seconds'] ?? 0 ?>;

						function updateCountdown() {
							if (remaining <= 0) return;

							let d = Math.floor(remaining / 86400);
							let h = Math.floor((remaining % 86400) / 3600);
							let m = Math.floor((remaining % 3600) / 60);
							let s = remaining % 60;

							document.getElementById("countdown").innerHTML =
								`${d} Days ${h} Hours ${m} Minutes ${s} Seconds`;

							remaining--;

							setTimeout(updateCountdown, 1000);
						}

						updateCountdown();
						</script>

						<?php
						// Clear session after showing
						unset($_SESSION['withindaysemsg']);
						unset($_SESSION['rem_seconds']);
						?>

						<div class="btn-box">
							<a href="<?= $config['rvuserinfo']['base_url']; ?>/calculator.php?tools=fund-performance" class="btn btn-primary">Continue</a>
						</div>

					<?php }else { ?>
						<?php if (isset($_SESSION['rvrhName'])) { ?>
							<p><?= $_SESSION['rvrhprofilemsg'] ?></p>
							<div class="btn-box">
								<a href="<?= $config['rvuserinfo']['base_url']; ?>" class="btn btn-primary">Go To Home</a>
							</div>
							<?php
							 unset($_SESSION['rvrhName']); 
							 unset($_SESSION['rvrhprofilemsg']); 
							 ?>
						<?php  } }  ?>
					</div>
				</div>
			</div>
		</section>

	</body>

</html>