<?php

$url = "https://www.redvisiontechnologies.com/api/sebi-audit/AMFI_Code-of-Conduct.pdf";

// साफ buffer
while (ob_get_level()) {
    ob_end_clean();
}

// cURL init
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$data = curl_exec($ch);

if (curl_errno($ch)) {
    die("cURL Error: " . curl_error($ch));
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

curl_close($ch);

// Validate
if ($httpCode != 200) {
    die("HTTP Error: " . $httpCode);
}

if (strpos($contentType, 'pdf') === false) {
    die("Not a PDF. Got: " . $contentType);
}

// Headers
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"AMFI_Code-of-Conduct.pdf\"");
header("Cache-Control: no-cache");
header("Content-Length: " . strlen($data));
// ❌ DO NOT SET Content-Length

echo $data;
exit;
?>