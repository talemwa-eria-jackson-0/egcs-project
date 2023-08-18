<?php
// Include necessary database connection and configuration
include('connection.php');

if (!empty($_GET['formid'])) {
    $formid = $_GET['formid'];

    // Update the database to mark the request as allowed
    $db->query("UPDATE clearance SET allowed = 1 WHERE formid = '$formid'");

    // Redirect back to the clearance_requests.php page
    header("Location: clearance_requests.php");
    exit;
}
?>
