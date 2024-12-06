<?php
session_start();
require_once 'dbConnect.php'; 
require_once 'user.php';
require_once 'adoption_request.php';

$database = new Database();
$db = $database->getConnect(); 

if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $user_contact = $_POST['user_contact'];
    $email = $_POST['email'];
    $vet_name = $_POST['vet_name'];
    $exercise_plan = $_POST['exercise_plan'];
    $emergency_care = $_POST['emergency_care'];
    $date = date("Y-m-d H:i:s"); // Add the current date and time

    // Validate if the user exists
    $stmt = $db->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    if ($stmt->rowCount() == 0) {
        die("Error: The specified user_id does not exist.");
    }

    // Validate if the animal exists
    $stmt = $db->prepare("SELECT id FROM animals WHERE id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);
    if ($stmt->rowCount() == 0) {
        die("Error: The specified animal_id does not exist.");
    }

    // Insert the adoption request with 'Reserved' status
    $query = "INSERT INTO adoption_requests (animal_id, user_id, user_contact, email, vet_name, exercise_plan, emergency_care, date, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Reserved')";
    $stmt = $db->prepare($query);
    $stmt->execute([$animal_id, $user_id, $user_contact, $email, $vet_name, $exercise_plan, $emergency_care, $date]);

    // Update the animal status to 'Reserved'
    $updateAnimalQuery = "UPDATE animals SET status = 'Reserved' WHERE id = ?";
    $updateStmt = $db->prepare($updateAnimalQuery);
    $updateStmt->execute([$animal_id]);

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
         <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <title>Success</title>
    </head>
    <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'Your adoption request has been submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(function() {
            window.location.href = 'view_animals.php'; // Redirect to view_animals.php after SweetAlert
        });
    </script>
    </body>
    </html>";
}
?>