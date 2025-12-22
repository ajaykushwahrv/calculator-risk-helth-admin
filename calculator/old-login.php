<?php 
    function fetchallLoginDataAPI() {
        $baseUrl = "https://redvisiontechnologies.com/api/web_login.php"; // Use full URL if using from another domain
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

// Error / empty data handle
if (isset($allLoginData['error'])) {
    echo "<p style='color:red;'>Error: " . htmlspecialchars($allLoginData['error']) . "</p>";
} elseif (empty($allLoginData) || !is_array($allLoginData)) {
    ?>
                    
    


<label class="form-check-label ">
                        <input type="radio" class="form-check-input pl-2" name="loginType" id="rvlogin1" value="CLIENT" checked="checked">Client                      </label>



<label class="form-check-label ">
                        <input type="radio" class="form-check-input pl-2" name="loginType" id="rvlogin2" value="EMPLOYEE">Employee                      </label>



<label class="form-check-label ">
                        <input type="radio" class="form-check-input pl-2" name="loginType" id="rvlogin3" value="ADVISOR">Admin                      </label>
                    
                    <?php 
} else { $i=1;  foreach($allLoginData as $allLogin): if( $allLogin['login_type'] != 1 ) continue; 
?>



<label class="form-check-label ">
                        <input type="radio" class="form-check-input pl-2" name="loginType"  id="rvlogin<?= $allLogin['id']; ?>"
                            value="<?= $allLogin['radio_value']; ?>" <?php switch($i){ case 1: echo "checked='checked'"; break; } ?>><?= $allLogin['radio_name']; ?>
                    </label>
<?php $i++;  endforeach;  } ?>