<?php
 function fetchDatasingleAPI($urlName) {
    if (is_array($urlName)) {
        $urlName = implode(',', $urlName);
    }
    $baseUrl = "https://www.redvisiontechnologies.com/api/calculatorsget.php";
    $url = $baseUrl . "?urlName=" . urlencode($urlName);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);

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
?>