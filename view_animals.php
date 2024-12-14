<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'dbConnect.php';

class AvailableAnimal
{
    private $conn;
    private $table_name = "animals";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAvailableAnimals()
    {
        $query = "SELECT id, name, age, sex, treatments, animal_type, size, energy_level, personality, rescue_date, status FROM " . $this->table_name . " WHERE status = 'Available'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$database = new Database();
$db = $database->getConnect();

$animalAvailable = new AvailableAnimal($db);

$availableAnimals = $animalAvailable->getAvailableAnimals();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/view_animal.css">
    <title>Animal List</title>
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
    <h1>Animal List</h1>

    <?php if (count($availableAnimals) > 0): ?>
        <div class="animal-section">
            <h3>Dogs</h3>
            <?php
            $hasDogs = false;
            foreach ($availableAnimals as $row) {
                if (strtolower($row['animal_type']) === 'dog') {
                    $hasDogs = true;
                    echo "<div class='animal-card'>";
                    echo "<h4>" . htmlspecialchars($row['name'] ?? 'Unknown') . "</h4>";
                    echo "<p><strong>Age:</strong> " . htmlspecialchars($row['age'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Sex:</strong> " . htmlspecialchars($row['sex'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Size:</strong> " . htmlspecialchars($row['size'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Energy Level:</strong> " . htmlspecialchars($row['energy_level'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Personality:</strong> " . htmlspecialchars($row['personality'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Treatments:</strong> " . htmlspecialchars($row['treatments'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Rescue Date:</strong> " . htmlspecialchars($row['rescue_date'] ?? 'N/A') . "</p>";
                    echo "<form action='adoption_form.php' method='GET'>
                            <input type='hidden' name='animal_id' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit'>Adopt</button>
                        </form>";
                    echo "</div>";
                }
            }
            if (!$hasDogs) {
                echo "<p>No dogs found.</p>";
            }
            ?>

            <h3>Cats</h3>
            <?php
            $hasCats = false;
            foreach ($availableAnimals as $row) {
                if (strtolower($row['animal_type']) === 'cat') {
                    $hasCats = true;
                    echo "<div class='animal-card'>";
                    echo "<h4>" . htmlspecialchars($row['name'] ?? 'Unknown') . "</h4>";
                    echo "<p><strong>Age:</strong> " . htmlspecialchars($row['age'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Sex:</strong> " . htmlspecialchars($row['sex'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Size:</strong> " . htmlspecialchars($row['size'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Energy Level:</strong> " . htmlspecialchars($row['energy_level'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Personality:</strong> " . htmlspecialchars($row['personality'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Treatments:</strong> " . htmlspecialchars($row['treatments'] ?? 'N/A') . "</p>";
                    echo "<p><strong>Rescue Date:</strong> " . htmlspecialchars($row['rescue_date'] ?? 'N/A') . "</p>";
                    echo "<form action='adoption_form.php' method='GET'>
                            <input type='hidden' name='animal_id' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit'>Adopt</button>
                        </form>";
                    echo "</div>";
                }
            }
            if (!$hasCats) {
                echo "<p>No cats found.</p>";
            }
            ?>
        </div>
    <?php else: ?>
        <p class='no-animals'>No animals found.</p>
    <?php endif; ?>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>