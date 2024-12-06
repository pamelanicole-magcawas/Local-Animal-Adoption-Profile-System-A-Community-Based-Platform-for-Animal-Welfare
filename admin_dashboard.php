<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Get the admin's permissions
$permissions = $_SESSION['permissions'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style/admin_dashboard.css">
</head>
<body>
    <nav>
        <ul>
            <?php if (in_array('manage_animals', $permissions)) { ?>
                <li><a href="admin_animals.php">Manage Animals</a></li>
            <?php } ?>
            <?php if (in_array('manage_donations', $permissions)) { ?>
                <li><a href="admin_donations.php">Manage Donations</a></li>
            <?php } ?>
            <?php if (in_array('manage_adoptions', $permissions)) { ?>
                <li><a href="admin_adoptions.php">Manage Adoptions</a></li>
            <?php } ?>
            <?php if (in_array('manage_users', $permissions)) { ?>
                <li><a href="admin_users.php">Manage Users</a></li>
            <?php } ?>
            <?php if (in_array('manage_reports', $permissions)) { ?>
                <li><a href="admin_reports.php">Manage Reports</a></li>
            <?php } ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Select an option from the navigation to manage the system.</p>
    </div>
</body>
</html>
