<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>


<?php
 ob_start();
session_start();

include("./rvm-include/config.php");
include "./rvm-include/rvfcaptcha_generate.php";

 

$formval = 'enqu';
$formKey = 'rvenqu';
$formKeyName = 'Enqury';
	$rvrrf = $formval . 'rvrrf';	

$captcha_contact = handleCaptcha($formKey . '_' . $formval);
if (!isset($_SESSION[$rvrrf]) || !is_array($_SESSION[$rvrrf])) {
    $_SESSION[$rvrrf] = [];
}
if (empty($_SESSION[$rvrrf][$formKey])) {
    $_SESSION[$rvrrf][$formKey] = bin2hex(random_bytes(32));
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
		<form  id="secureForm" method="POST" action="rvscmail.php" data-key="<?= $formval;?>"  onsubmit="return validate();">
	<?php if(isset($_GET['err']) && $_GET['err']=="captcha_err"){
			echo "<span style='color:red;'>Invalid Captcha. Please resubmit form!</span>";
			}
			

			?>
	<div class="">

		<input type="hidden" name="<?= $formval;?>rvrrf" value="<?= $_SESSION[$rvrrf][$formKey] ?>">
		<input type="hidden" name="<?= $formval;?>_hp_<?= $formKey;?>" class="honeypot">
		<input type="hidden" name="<?= $formval;?>form_key" value="<?= $formKey;?>">
		<input type="hidden" name="form_val" value="<?= $formval;?>">
		<input type="hidden" name="<?= $formval;?>_rvrformtype" value="<?= $formKeyName; ?>">
		<input type="hidden" name="<?= $formval;?>_rvrformname" value="New <?= $formKeyName; ?> Inquiry Received from Website">

		<div class="form-group">
			<label for='rvrname_<?= $formval;?>'>Name</label>
			<input type="text" name="<?= $formval;?>_rvusersName" id="rvrname_<?= $formval;?>">
			<span id="rvrname_err_<?= $formval;?>" class="error"></span>
		</div>
		<div class="form-group">
			<label for='rvrname_<?= $formval;?>'>Email</label>
			<input type="text" name="<?= $formval;?>_rvruserEmail" id="rvremail_<?= $formval;?>">
			<span id="rvremail_err_<?= $formval;?>" class="error"></span>
		</div>

		<div class="form-group">
			<label for='mobile_<?= $formval;?>'>Mobile</label>
			<input type="number" name="<?= $formval;?>_rvrmobile" id="mobile_<?= $formval;?>" maxlength="10">
			<span id="rvrmobile_err_<?= $formval;?>" class="error"></span>
		</div>
		<div class="form-group">
			<label for='service_<?= $formval;?>'>Service</label>
			<select name="<?= $formval;?>_cfservices" id="service<?= $formval;?>">
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
			 <label for='rvrmessage_<?= $formval;?>'>Message</label>
			 <textarea name="<?= $formval;?>_rvrmessage" id="rvrmessage_<?= $formval;?>"></textarea>
			 <span id="rvrmessage_err_<?= $formval;?>" class="error"></span>
		</div>
		<div class="form-group">
			<label for='rvrname_<?= $formval;?>'>Solve: <b id="cap_<?= $formKey . '_' . $formval ?>"><?= $captcha_contact ?> </b> = ? </label>
			<div class=""> 
				 <input type="number" name="<?= $formKey . '_' . $formval ?>_captcha" id="rvfcaptcha" maxlength="3" required>
				<a href="#!" type="button"  class="btn btn-primary"  onclick="refreshCaptcha('<?= $formKey . '_' . $formval ?>')" id="refreshCaptcha">↻</a>
			</div>
				 
		</div>


            </div>
            <div class="back-links">
                <button type="submit" class="btn btn-primary" id="submitBtn_<?= $formval;?>" disabled>Submit</button>
            </div>
        </form>
	</div>
</body>
	<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_js']; ?>"></script>
<?php ob_end_flush(); ?>
</html>