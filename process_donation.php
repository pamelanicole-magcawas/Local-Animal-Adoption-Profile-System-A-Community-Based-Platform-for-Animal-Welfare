<?php
session_start();

require_once 'DatabaseConnection.php';
require_once 'donation.php';

$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();
$donation = new Donation($conn);

function redirectWithMessage($type, $message, $location = 'donation_form.php') {
    $_SESSION['alertType'] = $type;
    $_SESSION['alertMessage'] = $message;
    header("Location: $location");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    $user_id = $_SESSION['user_id'];

    // Validate donation amount
    if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
        redirectWithMessage('error', 'Please enter a valid donation amount.');
    }

    // Validate message
    if (empty($message) || strlen($message) > 255) {
        redirectWithMessage('error', 'Message is required and must be less than 255 characters.');
    }

    // Process the donation
    if ($donation->addDonation($user_id, $amount, $message)) {
        redirectWithMessage('success', 'Your donation has been successfully processed.');
    } else {
        redirectWithMessage('error', 'There was an error processing your donation.');
    }
}

$totalApproved = $donation->getTotalApprovedDonations();
?>
