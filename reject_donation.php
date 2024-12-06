<?php
session_start();

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ensure that the admin is redirected to the correct dashboard
if ($_SESSION['username'] !== 'admin3') {
    header("Location: login.php"); // Redirect back if not admin1
    exit();
}

require_once 'DatabaseConnection.php';
require_once 'donation.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Initialize database and donation object
    $database = new DatabaseConnection();
    $conn = $database->getConnect();
    $donation = new Donation($conn);
    
    // Reject the donation
    if ($donation->rejectDonation($id)) {
        header('Location: admin_donations.php');
    } else {
        echo 'Error rejecting donation.';
    }
}
?>
