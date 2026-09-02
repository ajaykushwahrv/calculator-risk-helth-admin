<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require __DIR__ . '/sfa_config.php';

// PDO connection
$pdo = new PDO(
	$config['db']['dsn'],
	$config['db']['user'],
	$config['db']['pass'],
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// MySQLi connection
$con = mysqli_connect("localhost", $config['db']['user'], $config['db']['pass'], $config['db']['rdata']);

if (!$con) {
	die("MySQLi Connection failed: " . mysqli_connect_error());
}


// Fetch callbackUrl data siteUrl  

$callbackUrl = rtrim($config['rvuserinfo']['base_url'], '/') . '/' . ltrim($config['rvlogin']['callbackUrl'], '/');
$siteUrl = !empty($config['rvlogin']['wheatlebalsiteUrl']) ? $config['rvlogin']['wheatlebalsiteUrl'] : $config['rvlogin']['siteUrl'];

// Fetch App links 
$androidUrl = !empty($config['webapplinks']['androidUrl']) ? $config['webapplinks']['androidUrl'] : 'https://play.google.com/store/search?q=wealth+elite&c=apps';
$iosUrl = !empty($config['webapplinks']['iosUrl']) ? $config['webapplinks']['iosUrl'] : 'https://apps.apple.com/us/app/wealth-elite/id1518518606';

// Fetch Audit data by slug

// Fetch  Audit footer content



// Fetch single calculator data by urlName
function fetchDatasingleAPI($urlName)
{
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
// Fetch all calculators data
function fetchallDataAPI($con)
{
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




// FETCH SINGLE DATA
function rvFetchSingleDatanconf($con, $id, $column, $table)
{
	// Create a prepared statement
	$stmt = mysqli_prepare($con, "SELECT * FROM $table WHERE $column = ? ORDER BY id DESC LIMIT 1");
	if ($stmt === false) {
		// Log the error and handle it gracefully
		error_log('Prepare failed: ' . mysqli_error($con));
		return false; // Return false or handle the error accordingly
	}
	// Bind the id parameter to the prepared statement
	mysqli_stmt_bind_param($stmt, 'i', $id);

	// Execute the query
	if (!mysqli_stmt_execute($stmt)) {
		// Log the error and handle it gracefully
		error_log('Execute failed: ' . mysqli_stmt_error($stmt));
		return false; // Return false or handle the error accordingly
	}
	// Get the result set from the prepared statement
	$result = mysqli_stmt_get_result($stmt);
	if ($result === false) {
		// Log the error and handle it gracefully
		error_log('Get result failed: ' . mysqli_stmt_error($stmt));
		return false; // Return false or handle the error accordingly
	}
	// Fetch the row as an associative array
	$row = mysqli_fetch_assoc($result);
	// Free the result set
	mysqli_free_result($result);
	// Close the statement
	mysqli_stmt_close($stmt);

	return $row;
}
$userinfo = rvFetchSingleDatanconf($con, 1, 'id', 'admin');

function insertrvLeads($con, $cfusersName, $cfmobile, $cfuserEmail, $cfservices, $cfmessage, $cfformtype)
{
	// SECURITY: Sanitize Inputs
	$cfusersName = substr(trim(strip_tags($cfusersName)), 0, 100);
	$cfmobile = substr(preg_replace('/[^0-9]/', '', $cfmobile), 0, 15);
	$cfuserEmail = substr(trim($cfuserEmail), 0, 150);
	$cfservices = substr(trim(strip_tags($cfservices)), 0, 150);
	$cfmessage = substr(trim(strip_tags($cfmessage)), 0, 2000);
	$cfformtype = substr(trim(strip_tags($cfformtype)), 0, 100);
	$today = date("Y-m-d");
	// Email validate
	if (!filter_var($cfuserEmail, FILTER_VALIDATE_EMAIL)) {
		return false;
	}

	// Mobile validate
	if (!preg_match('/^[0-9]{10,15}$/', $cfmobile)) {
		return false;
	}

	// Prepared statement
	$stmt = $con->prepare("
        INSERT INTO rvrhc_leads (username, mobile, email, services, message, form_lead_name, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

	if (!$stmt) {
		error_log("Prepare failed: " . $con->error);
		return false;
	}

	$stmt->bind_param("sssssss", $cfusersName, $cfmobile, $cfuserEmail, $cfservices, $cfmessage, $cfformtype, $today);

	$result = $stmt->execute();
	$stmt->close();

	return $result;
}




function rvFetchAllDataSpecificnconf($con, $id, $column, $table)
{
	// Create a prepared statement
	$stmt = mysqli_prepare($con, "SELECT * FROM $table WHERE $column =?");
	if ($stmt === false) {
		// Handle error - in a real-world application, you might log this and return an appropriate response
		die('Prepare failed: ' . htmlspecialchars(mysqli_error($con)));
	}
	// Bind the id parameter to the prepared statement
	mysqli_stmt_bind_param($stmt, 's', $id);
	// Execute query
	if (!mysqli_stmt_execute($stmt)) {
		// Handle error - in a real-world application, you might log this and return an appropriate response
		die('Execute failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
	}
	// Get the result set from the prepared statement
	$resultAll = mysqli_stmt_get_result($stmt);
	if ($resultAll === false) {
		// Handle error - in a real-world application, you might log this and return an appropriate response
		die('Get result failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
	}
	// Fetch all rows as an associative array
	$dataAll = [];
	while ($row = mysqli_fetch_assoc($resultAll)) {
		// Optionally, you can sanitize the output here if you plan to display it directly
		$dataAll[] = $row;
	}
	// Free the result set
	mysqli_free_result($resultAll);
	// Close the statement
	mysqli_stmt_close($stmt);
	return $dataAll;
}

// useful links

function fetchallusefullinksDataAPI()
{
	$baseUrl = "https://redvisionweb.com/api/open-apis/useful-links?apikey=fc1017dad92f3bbbd9cee9bc21d4b0e0";
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

$usefullinksData = fetchallusefullinksDataAPI();

// Login
function fetchallLoginDataAPI()
{
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

// All audit pages data


$config_data = $config['rvuserinfo'];
function rv_apiCall($endpoint, $config_data = [])
{
	$api_key = "123456ABC";
	// ✅ api_key added
	$api_url = "https://www.redvisiontechnologies.com/api/sebi-audit/$endpoint?api_key=$api_key";
	$ch = curl_init($api_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, [
		'config_data' => json_encode($config_data)
	]);
	$response = curl_exec($ch);
	if ($response === false) {
		return "cURL Error: " . curl_error($ch);
	}
	curl_close($ch);
	$data = json_decode($response, true);
	if (!$data) {
		return "Invalid JSON response from API";
	}
	return $data;
}
$data = rv_apiCall("audit-links.php", $config_data);
$rvasallaudits = $data['audit_links'] ?? [];


function rv_fetchDynamic($slug, $config_data = [])
{
	$data = rv_apiCall($slug . ".php", $config_data);
	$key = str_replace('-', '_', $slug);
	return $data[$key] ?? ($slug . " not found");
}










?>