
<?php session_start(); include("./rvm-include/config.php"); ?>


<link rel="stylesheet" href="<?= $config['rvrhcinfo']['rvrhc_bootstrap_icons']; ?>">
<link rel="stylesheet" href="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_css']; ?>">
    <form  id="secureForm" method="POST" action="rvscmail.php" onsubmit="return validate();">
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
			<label for='rvrname'>Solve: <b id="cap_label"><?= $rvfa ?> + <?= $rvfb ?> </b> = ? </label>
			<div class="rvfmathcaptcha"> 
			 <input type="number" name="rvfmath_captcha" id="rvfcaptcha" maxlength="3">
			<a href="#!" type="button"  class="btn btn-primary"  id="refreshCaptcha">↻</a>
			</div>
			<span id="captcha_err" class="error"><?php if(isset($_GET['err']) && $_GET['err']=="captcha_err"){
        echo "<span style='color:red;'>Invalid Captcha. Please resubmit form!</span>";
        }?></span>
                </div>


            </div>
            <div class="back-links">
                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
            </div>
        </form>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_jquery360']; ?>"></script>
<script src="<?= $config['rvuserinfo']['base_url']; ?><?= $config['rvrhcinfo']['rvrhc_rvrh_js']; ?>"></script>
