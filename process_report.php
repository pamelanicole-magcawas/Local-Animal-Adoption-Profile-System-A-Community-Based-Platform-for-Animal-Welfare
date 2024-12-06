<?php
session_start();
require_once 'DatabaseConnection.php';
require_once 'reports.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();

$report = new Report($conn);

// Define $user_id from session
$user_id = $_SESSION['user_id'];  // Use the logged-in user's ID from session

// Fetch user details using the getUserDetailsById method
$user = $report->getUserDetailsById($user_id);
$user_name = $user ? $user['username'] : ''; 
$email = $user ? $user['email'] : ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $message = $_POST['message'];
    
    if ($report->processReportSubmission($user_id, $full_name, $message)) {
        header("Location: report_form.php?status=success"); 
        exit();
    } else {
        header("Location: report_form.php?status=error"); 
        exit();
    }
}
?>
