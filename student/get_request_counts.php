<?php
include 'header.php'; // Include the header file which contains the database connection

// Fetch the request counts
$acceptedRequests = $db->query("SELECT * FROM clearance WHERE formStatus = '1'")->num_rows;
$rejectedRequests = $db->query("SELECT * FROM clearance WHERE formStatus = '2'")->num_rows;
$pendingRequests = $db->query("SELECT * FROM clearance WHERE formStatus = ''")->num_rows;

// Return the request counts as JSON
$response = [
    'acceptedRequests' => $acceptedRequests,
    'rejectedRequests' => $rejectedRequests,
    'pendingRequests' => $pendingRequests,
];

header('Content-Type: application/json');
echo json_encode($response);
?>
