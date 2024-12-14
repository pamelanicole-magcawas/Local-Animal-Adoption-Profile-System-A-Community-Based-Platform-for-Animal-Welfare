<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'DatabaseConnection.php';
require_once 'dbConnect.php';
require_once 'donation.php';
require_once 'adoption_request.php';
require_once 'user.php';
require_once 'Reports.php';

$databaseConnection = new DatabaseConnection();
$conn = $databaseConnection->getConnect();

$donation = new Donation($conn);
$user = new User($conn);
$adoptionRequest = new AdoptionRequest($conn);
$report = new Report($conn);

$userId = $_SESSION['user_id'];
$userData = $user->getUserById($userId);
$donations = $donation->getDonationsByUserId($userId);
$adoptionRequests = $adoptionRequest->getAdoptionRequestsByUserId($userId);
$reports = $report->getReportsByUserId($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <title>Dashboard</title>

    <script>
        $(document).ready(function() {
            $('#donationTable').DataTable();
            $('#adoptionTable').DataTable();
            $('#reportTable').DataTable();
        });
    </script>

    <link rel="stylesheet" href="style/user_dashboard.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="user_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="view_animals.php"><i class="fas fa-paw"></i> Our Animals</a></li>
            <li><a href="donation_form.php"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="pet_services.php"><i class="fas fa-band-aid"></i> Pet Care Services</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="report_form.php"><i class="fas fa-exclamation-circle"></i> Report</a></li>
            <li><a href="dashboard.php"><i class="fas fa-user"></i> Dashboard</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="section">
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard! Here you can view the donations you've made, the pets you've adopted, your submitted reports, and other relevant details. Stay tuned for future updates!</p>
    </div>

    <div class="dashboard-container">
        <!-- Profile Section -->
        <div class="section">
            <h2>Your Profile</h2>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($userData['id']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($userData['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        </div>

        <!-- Donations Table -->
        <div class="section">
            <h2>Your Donations</h2>
            <table id="donationTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Message</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($donations->rowCount() > 0): ?>
                        <?php while ($row = $donations->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Adoption Requests Table -->
        <div class="section">
            <h2>Your Adoption Requests</h2>
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
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($adoptionRequests->rowCount() > 0): ?>
                        <?php while ($row = $adoptionRequests->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['request_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['animal_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_contact']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['vet_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['exercise_plan']); ?></td>
                                <td><?php echo htmlspecialchars($row['emergency_care']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Reports Table -->
        <div class="section">
            <h2>Your Reports</h2>
            <table id="reportTable" class="display">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($reports->rowCount() > 0): ?>
                        <?php while ($row = $reports->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>
