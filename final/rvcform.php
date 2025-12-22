
<?php session_start(); 
include("./rvm-include/config.php"); 
include "./rvm-include/rvfcaptcha_generate.php";
 $captcha_contact = generateCaptcha("contact");
?>



<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
<link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">
    <form  id="secureForm" method="POST" action="rvscmail.php" onsubmit="return validate();">
	<?php if(isset($_GET['err']) && $_GET['err']=="captcha_err"){
			echo "<span style='color:red;'>Invalid Captcha. Please resubmit form!</span>";
			}
			$_SESSION['rvrrf'] = bin2hex(random_bytes(32));
			?>
	<div class="">

		<input type="hidden" name="rvrrf" value="<?= $_SESSION['rvrrf'] ?>">
		<input type="hidden" name="my_address" class="honeypot">
		<input type="hidden" name="rvrformtype" value="Contact">

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
			<label for='rvrname'>Mobile</label>
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
				 <input type="number" name="contact_captcha" id="rvfcaptcha" maxlength="3" required>
				<a href="#!" type="button"  class="btn btn-primary"  onclick="refreshCaptcha('contact')" id="refreshCaptcha">↻</a>
			</div>
				 
		</div>


            </div>
            <div class="back-links">
                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
            </div>
        </form>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_js']; ?>"></script>
