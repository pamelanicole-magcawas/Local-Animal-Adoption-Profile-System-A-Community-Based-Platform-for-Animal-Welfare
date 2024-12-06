<?php

require_once 'DatabaseConnection.php';
require_once 'reports.php';

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SESSION['username'] !== 'admin1') {
    header("Location: login.php");
    exit();
}

if ($_SESSION['username'] !== 'admin1') {
    header("Location: login.php");
}

$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();

$report = new Report($conn);
$reports = $report->getAllReports(); // Get all reports

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $report_id = $_POST['report_id'];
    if ($report->updateStatus($report_id, 'Read')) {
        header('Location: admin_reports.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/admin_reports.css">
    <title>Admin - View Reports</title>

    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable();
        });
    </script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="admin_animals.php">Manage Animals</a></li>
            <li><a href="admin_reports.php">Manage Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h1>All Submitted Reports</h1>
    <table id="reportTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($report = $reports->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($report['id']); ?></td>
                    <td><?php echo htmlspecialchars($report['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($report['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($report['email']); ?></td>
                    <td><?php echo htmlspecialchars($report['message']); ?></td>
                    <td><?php echo htmlspecialchars($report['status']); ?></td>
                    <td><?php echo htmlspecialchars($report['date']); ?></td>
                    <td>
                        <?php if ($report['status'] == 'Unread'): ?>
                            <form action="admin_reports.php" method="POST">
                                <input type="hidden" name="report_id" value="<?php echo $report['id']; ?>">
                                <button type="submit">Mark as Read</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>
</html>
