<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="manage_reports.css">

    <script>
        $(document).ready(function() {
            $('#reportsTable').DataTable();
        });
    </script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="manage_animals.php">Manage Animals</a></li>
            <li><a href="manage_adoptions.php">Manage Adoptions</a></li>
            <li><a href="manage_donations.php">Manage Donations</a></li>
            <li><a href="manage_reports.php">Manage Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>List of Reports</h2>
    <table id="reportsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require_once 'dbConnect.php';
            require_once 'emergency_request.php';


            $database = new Database();
            $db = $database->getConnect();

            $emergencyRequest = new EmergencyRequest($db);
            $stmt = $emergencyRequest->read();
            $num = $stmt->rowCount();

            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['id']) ? htmlspecialchars($row['id']) : '') . "</td>";
                    echo "<td>" . (isset($row['user_name']) ? htmlspecialchars($row['user_name']) : '') . "</td>";
                    echo "<td>" . (isset($row['user_email']) ? htmlspecialchars($row['user_email']) : '') . "</td>";
                    echo "<td>" . (isset($row['user_phone']) ? htmlspecialchars($row['user_phone']) : '') . "</td>";
                    echo "<td>" . (isset($row['emergency_message']) ? htmlspecialchars($row['emergency_message']) : '') . "</td>";
                    echo "<td>" . (isset($row['timestamp']) ? htmlspecialchars($row['timestamp']) : '') . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>