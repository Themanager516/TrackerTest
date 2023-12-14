<?php

// Set the path to the log file
$logFilePath = __DIR__ . '/page_visits.log';

try {
    // Read the log file
    $logContents = file_get_contents($logFilePath);

    // Parse each line into an array
    $logLines = explode("\n", trim($logContents));

    // Process each line
    $logData = [];
    foreach ($logLines as $line) {
        // Skip empty lines
        if (empty($line)) {
            continue;
        }

        // Split the line into components based on the delimiter
        $components = explode(' | ', $line);

        // Extract relevant information
        $timestamp = trim($components[0]);
        $page = trim(str_replace('Page:', '', $components[1]));
        $ip = trim(str_replace('IP:', '', $components[2]));
        $userAgent = trim(str_replace('User Agent:', '', $components[3]));

        // Add data to the result array
        $logData[] = [
            'timestamp' => $timestamp,
            'page' => $page,
            'ip' => $ip,
            'userAgent' => $userAgent,
        ];
    }

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($logData);
} catch (Exception $e) {
    // Handle exceptions and return an error response
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
