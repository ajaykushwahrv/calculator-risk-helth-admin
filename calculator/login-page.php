<?php 
    function fetchallLoginDataAPI() {
        $baseUrl = "https://redvisiontechnologies.com/api/web_login.php"; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        if ($result === false) {
            return ["error" => "cURL Error: " . curl_error($ch)];
        }
        curl_close($ch);

        $decoded_result = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ["error" => "JSON Decode Error: " . json_last_error_msg()];
        }
        return $decoded_result;
    }

    $allLoginData = fetchallLoginDataAPI();
 
    if (isset($allLoginData['error']) || empty($allLoginData) || !is_array($allLoginData)) { 
?>
  
     
<?php } else { $i=1;   foreach($allLoginData as $allLogin):  if ($allLogin['login_type'] != 1) continue; ?>
     
    id="rvlogin<?= $allLogin['id']; ?>" value="<?= $allLogin['radio_value']; ?>" <?php switch($i){ case 1: echo "checked='checked'"; break; } ?>
    <?= $allLogin['radio_name']; ?>
    for="rvlogin<?= $allLogin['id']; ?>"


<?php $i++; endforeach; } ?>
							
					