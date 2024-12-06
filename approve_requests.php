<?php
require_once 'dbConnect.php';

$database = new Database();
$db = $database->getConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];
    $status = '';
    $user_id = '';

    // Get user_id from adoption request
    $stmt = $db->prepare("SELECT user_id FROM adoption_requests WHERE request_id = ?");
    $stmt->execute([$request_id]);
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        $user_id = $user_data['user_id'];
    }

    // Handle approve action
    if ($action == 'approve') {
        $update_query = "UPDATE adoption_requests SET status = 'Approved' WHERE request_id = ?";
        $stmt = $db->prepare($update_query);
        $stmt->execute([$request_id]);

        // Update the animal status to 'Adopted'
        $update_animal_query = "UPDATE animals SET status = 'Adopted' WHERE id = (SELECT animal_id FROM adoption_requests WHERE request_id = ?)";
        $stmt = $db->prepare($update_animal_query);
        $stmt->execute([$request_id]);

        $status = 'Approved';

    } 
    elseif ($action == 'reject') {
        $update_query = "UPDATE adoption_requests SET status = 'Rejected' WHERE request_id = ?";
        $stmt = $db->prepare($update_query);
        $stmt->execute([$request_id]);

        $get_animal_query = "SELECT animal_id FROM adoption_requests WHERE request_id = ?";
        $stmt = $db->prepare($get_animal_query);
        $stmt->execute([$request_id]);
        $animal_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($animal_data) {
            $animal_id = $animal_data['animal_id'];
            $update_animal_query = "UPDATE animals SET status = 'Available' WHERE id = ?";
            $stmt = $db->prepare($update_animal_query);
            $stmt->execute([$animal_id]);
        }

        $status = 'Rejected';
    }

    header("Location: admin_adoptions.php?status=$status");
    exit();
}
?>
