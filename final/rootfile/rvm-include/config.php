<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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


// Fetch single calculator data by urlName
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
// Fetch all calculators data
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


    

//Privacy Policy Function
function rv_fetchPrivacyPolicy($company_name, $email)
{
	
 
	// API URL where your PHP API is hosted
	$api_url = 'https://www.redvisiontechnologies.com/api/audit/privacy-policy.php?company_name=' . urlencode($company_name) . '&email=' . urlencode($email);
	// Initialize cURL session
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return "cURL Error: " . curl_error($ch);
    }
    curl_close($ch);

    $data = json_decode($response, true);

    if (!$data) {
        return "Invalid JSON response from API";
    }

    if (isset($data['privacy_policy'])) {
        return $data['privacy_policy'];
    } elseif (isset($data['data']['privacy_policy'])) {
        return $data['data']['privacy_policy'];
    } else {
        return "Privacy policy not found in API response";
    }
}


 //Commission Disclosure Function
function rv_fetchCommissionDisclosures($company_name = '')
{
	
 
	// API URL where your PHP API is hosted
	$api_url = 'https://www.redvisiontechnologies.com/api/audit/commission-disclosures.php?company=' . urlencode($company_name) ;
	// Initialize cURL session
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }
    curl_close($ch);

    $data = json_decode($response, true);

    if (!$data) {
        return "Invalid JSON response from API";
    }

    // ✅ CORRECT KEY
    if (isset($data['commission_disclosures'])) {
        return $data['commission_disclosures'];
    } else {
        return "Commission Disclosure not found in API response";
    }
}



//Commission Disclosure Function
function rv_fetchfooterContent($company_name = '')
{
	
 
	// API URL where your PHP API is hosted
	$api_url = 'https://www.redvisiontechnologies.com/api/audit/footer-content.php?company=' . urlencode($company_name) ;
	// Initialize cURL session
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }
    curl_close($ch);

    $data = json_decode($response, true);

    if (!$data) {
        return "Invalid JSON response from API";
    }

    // ✅ CORRECT KEY
    if (isset($data['footer_content'])) {
        return $data['footer_content'];
    } else {
        return "Footer Content not found in API response";
    }
}

 //Risk Factors Function
function rv_fetchRiskFactors()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/risk-factors.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['risk_factors']) && $data['risk_factors'] !== '') {
        return $data['risk_factors'];
    }

    return "Risk Factors not found in API response";
}

 //Terms & Conditions Function

function rv_fetchTermsConditions()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/terms-conditions.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['terms_conditions']) && $data['terms_conditions'] !== '') {
        return $data['terms_conditions'];
    }

    return "Terms & Conditions not found in API response";
}

 //Investor grievance redressal Function


function rv_fetchInvestorGrievanceRedressal(array $params = [])
{
    $baseUrl = 'https://www.redvisiontechnologies.com/api/audit/investor-grievance-redressal.php';

    // default parameters
    $defaultParams = [
        'clientname' => '',
        'websitename' => '',
        'mobile'      => '',
        'mobile1'     => '',
        'mobile2'     => '',
        'mobile3'     => '',
        'mobile4'     => '',
        'email'       => '',
        'email1'      => '',
        'email2'      => '',
        'email3'      => '',
        'address'     => '',
        'address1'    => '',
        'address2'    => '',
    ];

    // merge defaults with passed params
    $queryParams = array_merge($defaultParams, $params);

    // build API URL
    $api_url = $baseUrl . '?' . http_build_query($queryParams);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return "cURL Error: " . curl_error($ch);
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (!$data) {
        return "Invalid JSON response from API";
    }

    // flexible response handling
    if (isset($data['investor_grievance_redressal'])) {
        return $data['investor_grievance_redressal'];
    } elseif (isset($data['data']['investor_grievance_redressal'])) {
        return $data['data']['investor_grievance_redressal'];
    } else {
        return "Investor grievance redressal content not found in API response";
    }
}


 //Terms & Conditions Function

function rv_fetchImportantLinks()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/important-links.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['important_links']) && $data['important_links'] !== '') {
        return $data['important_links'];
    }

    return "Important Links not found in API response";
}



 //SID/SAI/KIM Function

function rv_fetchSidsaikim()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/sidsaikim.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['sidsaikim']) && $data['sidsaikim'] !== '') {
        return $data['sidsaikim'];
    }

    return "SID/SAI/KIM not found in API response";
}




 //Code of Conduct Function

function rv_fetchCodeofConduct()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/code-of-conduct.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['codeofconduct']) && $data['codeofconduct'] !== '') {
        return $data['codeofconduct'];
    }

    return "Code of Conduct not found in API response";
}



 //SEBI Circulars Function

function rv_fetchCirculars()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/sebicirculars.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['sebicirculars']) && $data['sebicirculars'] !== '') {
        return $data['sebicirculars'];
    }

    return "SEBI Circulars not found in API response";
}


//Copyright Circulars Function

function rv_fetchCopyright()
{
    $api_url = 'https://www.redvisiontechnologies.com/api/audit/copyright.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    // ✅ SSL safety (agar hosting strict ho)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        return "cURL Error: " . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return "API Error: HTTP " . $httpCode;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON response from API";
    }

    // ✅ Correct key handling
    if (isset($data['copyright']) && $data['copyright'] !== '') {
        return $data['copyright'];
    }

    return "Copyright not found in API response";
}



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

function insertLeads($con, $cfusersName, $cfmobile, $cfuserEmail, $cfservices, $cfmessage, $cfformtype)
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

    function fetchallusefullinksDataAPI() {
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

?> 