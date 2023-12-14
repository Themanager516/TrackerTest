<?php
session_start();

// Track page visits with detailed information
function trackPageVisit($page) {
    $logFile = 'page_visits.log';

    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Get geolocation information
    $geolocation = getGeolocation($ip);

    // Include geolocation details in the log entry
    $logEntry = "$timestamp | Page: $page | IP: $ip | User Agent: $userAgent | Geolocation: ";
    $logEntry .= isset($geolocation['city']) ? $geolocation['city'] . ', ' : '';
    $logEntry .= isset($geolocation['region']) ? $geolocation['region'] . ', ' : '';
    $logEntry .= isset($geolocation['country']) ? $geolocation['country'] : '';
    $logEntry .= "\n";

    // Log detailed information
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}


// Handle AJAX request to track page visit
if (isset($_GET['trackPage'])) {
    $uniqueIdentifier = $_GET['trackPage'];
    $currentPage = basename($uniqueIdentifier);
    trackPageVisit($currentPage);

    // Get geolocation information
    $ip = $_SERVER['REMOTE_ADDR'];
    $geolocation = getGeolocation($ip);

    // Return geolocation data in response
    echo json_encode($geolocation);
    exit;
}


function getGeolocation($ip) {
    $apiKey = 'e8a0838e0fc244';
    $url = "https://ipinfo.io/$ip?token=$apiKey";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

?>
