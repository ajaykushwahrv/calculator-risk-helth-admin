<?php if (isset($allLoginData['error']) || empty($allLoginData) || !is_array($allLoginData)) { ?>
    <marquee behavior='' direction='' style='display: flex; align-items: center; color:red;'>We're currently experiencing a
     temporary server issue. Don't worry, our team is already working on it, and the Tools will be back online shortly.
     Thank you for your patience. </marquee>
     
<?php } else { $i=1; if (!empty($allLoginData)) {  foreach($allLoginData as $allLogin):  if ($allLogin['login_type'] != 1) continue; ?>
     
    id="rvlogin<?= $allLogin['id']; ?>" value="<?= $allLogin['radio_value']; ?>" <?php switch($i){ case 1: echo "checked='checked'"; break; } ?>
    <?= $allLogin['radio_name']; ?>
    for="rvlogin<?= $allLogin['id']; ?>"


<?php $i++; endforeach; } else { echo "<p>Currently Data not available. Please try again later.</p>"; } } ?>
							
					