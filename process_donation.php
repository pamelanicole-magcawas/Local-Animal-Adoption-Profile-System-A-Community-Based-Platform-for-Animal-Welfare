<?php
include 'db_donation.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $donation_amount = $_POST['donation_amount'];
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO Donations (first_name, last_name, email, donation_amount, payment_method)
            VALUES ('$first_name', '$last_name', '$email', '$donation_amount', '$payment_method')";

    if ($conn->query($sql) === TRUE) {
        echo "Donation recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
