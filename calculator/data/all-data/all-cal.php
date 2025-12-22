<?php  
    function fetchallDataAPI($con) {
        $baseUrl = "https://redvisiontechnologies.com/api/calculators.php"; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $result = curl_exec($ch);
        if ($result === false) {
            curl_close($ch);
            return ["error" => "cURL Error: " . curl_error($ch)];
        }
        curl_close($ch);

        $decoded_result = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ["error" => "JSON Decode Error: " . json_last_error_msg()];
        }
        
        return $decoded_result;
    }

    $allCulatorsDaat = fetchallDataAPI($con);

?>