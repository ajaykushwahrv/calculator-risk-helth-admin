<?php   

//Privacy Policy Function
function fetchPrivacyPolicy($company_name, $email)
{
// API URL where your PHP API is hosted
$api_url = 'https://websitesbazaar.com/api/privacy-policy-api.php?company_name=' . urlencode($company_name) . '&email=' . urlencode($email);
// Initialize cURL session
$ch = curl_init();
// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Execute cURL request and get response
$response = curl_exec($ch);
// Check for cURL errors
if (curl_errno($ch)) {
$error_msg = curl_error($ch);
curl_close($ch);
return "Error fetching the privacy policy: $error_msg";
}
// Close cURL session
curl_close($ch);
// Decode the JSON response
$data = json_decode($response, true);
// Check if the privacy policy exists in the response
if (isset($data['privacy_policy'])) {
return $data['privacy_policy'];
} else {
return "Privacy policy not found.";
}
}


?>

<?php echo $privacy_policy = fetchPrivacyPolicy($config['rvuserinfo']['name'], $config['rvuserinfo']['email']); ?>