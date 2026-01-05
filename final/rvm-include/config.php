<?php

// $allowed_ips = [
//     "103.231.44.222",  // First IP
//     "103.21.53.114"   // Second IP
// ];

// // User ka current IP
// $user_ip = $_SERVER['REMOTE_ADDR'];

// // Check access
// if (!in_array($user_ip, $allowed_ips)) {
//     die("Access Denied: Your IP  not allowed.");
// }

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

 

// FETCH SINGLE DATA
function rvFetchSingleDatas($con, $id, $column, $table)
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
$userinfo = rvFetchSingleData($con, 1, 'id', 'admin');

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
 



function rvFetchAllDataSpecific($con, $id, $column, $table)
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
?>