<?php

require_once 'dbConnect.php';
require_once 'user.php';

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SESSION['username'] !== 'admin3') {
    header("Location: login.php"); 
    exit();
}

$database = new Database();
$db = $database->getConnect();
$user = new User($db);

$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/admin_users.css">
    <title>Admin - Users List</title>

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
        });
    </script>
</head>
<body>
   <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="admin_donations.php">Manage Donations</a></li>
            <li><a href="admin_users.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h1>Users List</h1>
    <table id="usersTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($users) {
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['full_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-users'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>
</html>
