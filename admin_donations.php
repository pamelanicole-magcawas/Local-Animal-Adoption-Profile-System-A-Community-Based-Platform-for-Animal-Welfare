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

$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();

$donation = new Donation($conn);

$donations = $donation->getAllDonations();

$totalApprovedDonations = $donation->getTotalApprovedDonations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="style/admin_donations.css">
    <title>Admin - Donations</title>

    <script>
    $(document).ready(function() {
        $('#donationsTable').DataTable();  // Initialize DataTable on the table
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

    <h1>All Donations</h1>
    <p class="total-amount"><strong>Total Approved Donations: </strong>₱<?php echo number_format($totalApprovedDonations, 2); ?></p>

    <table id="donationsTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Message</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($donations->rowCount() > 0): ?>
            <?php while ($row = $donations->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['amount']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td>
                        <?php if ($row['status'] === 'Pending'): ?>
                            <a href="accept_donation.php?id=<?php echo $row['id']; ?>">Accept</a> | 
                            <a href="reject_donation.php?id=<?php echo $row['id']; ?>">Reject</a>
                        <?php else: ?>
                            <?php echo $row['status']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No donations found</td></tr>
        <?php endif; ?>
    </tbody>
</table>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>
</html>
