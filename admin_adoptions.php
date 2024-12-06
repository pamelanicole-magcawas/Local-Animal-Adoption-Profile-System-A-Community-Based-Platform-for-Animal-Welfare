<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SESSION['username'] !== 'admin2') {
    header("Location: login.php"); 
    exit();
}

require_once 'DatabaseConnection.php';
require_once 'adoption_request.php';

// Create database connection
$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();

// Instantiate AdoptionRequest object
$adoptionRequest = new AdoptionRequest($conn);

// Get all adoption requests
$requests = $adoptionRequest->getAllRequests();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Requests</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/admin_adoptions.css">

    <script>
        $(document).ready(function() {
            $('#adoptionTable').DataTable();
        });
    </script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="admin_adoptions.php">Manage Adoptions</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Adoption Requests</h2>

    <?php if ($requests->rowCount() > 0): ?>
        <table id="adoptionTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal</th>
                    <th>User Name</th>
                    <th>Contact Info</th>
                    <th>Email</th>
                    <th>Veterinarian</th>
                    <th>Exercise Plan</th>
                    <th>Emergency Care</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $requests->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['request_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['animal_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['vet_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['exercise_plan']); ?></td>
                        <td><?php echo htmlspecialchars($row['emergency_care']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'Reserved'): ?>
                                <form action="approve_requests.php" method="POST">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                    <select name="action" required>
                                        <option value="approve">Approve</option>
                                        <option value="reject">Reject</option>
                                    </select>
                                    <button type="submit">Submit</button>
                                </form>
                            <?php else: ?>
                                <span>Action completed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text">No adoption requests pending.</p>
    <?php endif; ?>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>