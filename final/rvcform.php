<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>


<?php
session_start();

include("./rvm-include/config.php");
include "./rvm-include/rvfcaptcha_generate.php";

if (!isset($_SESSION['rvrrf']) || !is_array($_SESSION['rvrrf'])) {
    $_SESSION['rvrrf'] = [];
}


$formKey = 'rvcontact';
$formKeyName = 'Contact Us';
$captcha_contact = generateCaptcha($formKey);
if (empty($_SESSION['rvrrf'][$formKey])) {
    $_SESSION['rvrrf'][$formKey] = bin2hex(random_bytes(32));
}
?>
 
<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
<link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="contact-box">
		<h2>Contact Us</h2>
		<form  id="secureForm" method="POST" action="rvscmail.php" onsubmit="return validate();">
	<?php if(isset($_GET['err']) && $_GET['err']=="captcha_err"){
			echo "<span style='color:red;'>Invalid Captcha. Please resubmit form!</span>";
			}
			

			?>
	<div class="">

		<input type="hidden" name="rvrrf" value="<?= $_SESSION['rvrrf'][$formKey] ?>">
		<input type="hidden" name="hp_<?= $formKey;?>" class="honeypot">
		<input type="hidden" name="form_key" value="<?= $formKey;?>">
		<input type="hidden" name="rvrformtype" value="<?= $formKeyName; ?>">
		<input type="hidden" name="rvrformname" value="New <?= $formKeyName; ?> Inquiry Received from Website">

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
			<input type="number" name="rvrmobile" id="mobile" maxlength="10">
			<span id="rvrmobile_err" class="error"></span>
		</div>
		<div class="form-group">
			<label for='rvrname'>Service</label>
			<select name="cfservices" id="service">
				<option value="">-- Select Service --</option>
				<?php $cfservices = [
					[ 'title'   => 'Mutual Funds'],
					[ 'title'   => 'Insurance & NPS'],
					[ 'title'   => 'Taxation'],
					[ 'title'   => 'Global Investing & P2P Lending'],
					[ 'title'   => 'Portfolio Managed Services'],
					[ 'title'   => 'Fixed Deposits'],
				]; ?>
				<?php foreach($cfservices as $cfservicesitems){ ?>
				<option value="<?= $cfservicesitems['title']; ?>"><?= $cfservicesitems['title']; ?></option>
				<?php  } ?>
			</select>
		</div>
		 <div class="form-group">
			 <label for='rvrname'>Message</label>
			 <textarea name="rvrmessage" id="rvrmessage"></textarea>
			 <span id="rvrmessage_err" class="error"></span>
		</div>
		<div class="form-group">
			<label for='rvrname'>Solve: <b id="cap_contact"><?= $captcha_contact ?> </b> = ? </label>
			<div class=""> 
				 <input type="number" name="<?= $formKey; ?>_captcha" id="rvfcaptcha" maxlength="3" required>
				<a href="#!" type="button"  class="btn btn-primary"  onclick="refreshCaptcha(<?= $formKey; ?>)" id="refreshCaptcha">↻</a>
			</div>
				 
		</div>


            </div>
            <div class="back-links">
                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
            </div>
        </form>
	</div>
</body>
	<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_js']; ?>"></script>

</html>