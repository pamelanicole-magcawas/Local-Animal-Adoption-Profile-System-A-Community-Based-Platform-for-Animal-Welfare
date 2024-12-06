<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SESSION['username'] !== 'admin3') {
    header("Location: login.php"); 
    exit();
}

require_once 'DatabaseConnection.php';
require_once 'donation.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $database = new DatabaseConnection();
    $conn = $database->getConnect();
    $donation = new Donation($conn);
    
    if ($donation->acceptDonation($id)) {
        header('Location: admin_donations.php');
    } else {
        echo 'Error accepting donation.';
    }
}
?>
