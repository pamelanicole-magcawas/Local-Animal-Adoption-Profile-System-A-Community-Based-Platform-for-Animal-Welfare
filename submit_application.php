<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form fields
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $adoption_reason = $_POST['adoption_reason'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO applications (name, email, phone, address, adoption_reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $adoption_reason);

    // Execute and check for success
    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
