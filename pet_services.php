<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'find_services.php';

$servicesObj = new PetServices();

$filters = [];
if (!empty($_GET['category'])) {
    $filters['category'] = $_GET['category'];
}

if (!empty($_GET['location'])) {
    $filters['location'] = $_GET['location'];
}

$services = $servicesObj->getServices($filters);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/pet_service.css">
    <title>Pet Services Finder</title>
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

    <div class="container">
        <h1>Pet Services Finder</h1>

        <form action="" method="get">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($_GET['category'] ?? ''); ?>">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($_GET['location'] ?? ''); ?>">

            <button type="submit">Filter</button>
            <button type="button" onclick="window.location.href='pet_services.php'">Clear Search</button>
        </form>

        <h2>Pet Services Recommendations</h2>
        <?php
        if ($services) {
            foreach ($services as $service) {
                echo "<div class='services-profile'>";
                echo "<h2>" . htmlspecialchars($service['name']) . "</h2>";
                echo "<p><strong>Location:</strong> " . htmlspecialchars($service['location']) . "</p>";
                echo "<p><strong>Contact Info:</strong> " . htmlspecialchars($service['contact_info']) . "</p>";
                echo "<p><strong>Category:</strong> " . htmlspecialchars($service['category']) . "</p>";
                echo "<p><strong>Services Offered:</strong> " . htmlspecialchars($service['services_offered']) . "</p>";
                echo "<p><strong>Open Hours:</strong> " . htmlspecialchars($service['availability']) . "</p>";
                echo "<p><strong>Rating:</strong> " . htmlspecialchars($service['rating']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No pet services found matching your criteria.</p>";
        }
        ?>
    </div>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>