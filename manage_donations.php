<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <link rel="stylesheet" href="style/donation.css">

    <script>
        $(document).ready(function() {
            $('#donationTable').DataTable();
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>List of Donations</h2>
    <table id="donationTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require_once 'db_donation.php';
            require_once 'donations.php';

            $database = new Database();
            $db = $database->getConnect();

            $donations = new Donations($db);
            $stmt = $donations->displayDonation();
            $num = $stmt->rowCount();

            $totalAmount = 0;
            if ($num > 0) {
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $totalAmount += isset($row['donation_amount']) ? floatval($row['donation_amount']) : 0;
                }
                $stmt->execute();
            }

            echo '<p class="total-amount"><strong>Total Amount Donated: </strong>PHP ' . number_format($totalAmount, 2) . '</p>';

            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['donation_id']) ? htmlspecialchars($row['donation_id']) : '') . "</td>";
                    echo "<td>" . (isset($row['name']) ? htmlspecialchars($row['name']) : '') . "</td>";
                    echo "<td>" . (isset($row['email']) ? htmlspecialchars($row['email']) : '') . "</td>";
                    echo "<td>" . (isset($row['donation_amount']) ? htmlspecialchars($row['donation_amount']) : '') . "</td>";
                    echo "<td>" . (isset($row['payment_method']) ? htmlspecialchars($row['payment_method']) : '') . "</td>";
                    echo "<td>" . (isset($row['donation_date']) ? htmlspecialchars($row['donation_date']) : '') . "</td>";
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