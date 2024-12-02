<?php
require_once 'dbConnect.php';
require_once 'crud.php';

$database = new Database();
$db = $database->getConnect();

$animal = new Animal($db);

$stmt = $animal->read();
$num = $stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/list.css">
    <title>Animal List</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="user_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="view_animals.php"><i class="fas fa-paw"></i> Our Animals</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="report.php"><i class="fas fa-exclamation-circle"></i> Report</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>
    <h2>Animal List</h2>

    <?php if ($num > 0): ?>
        <div class="animal-section">
            <h3>Dogs</h3>
            <?php
            $stmt->execute();
            $hasDogs = false;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (isset($row['Animal_Type']) && strtolower($row['Animal_Type']) === 'dog') {
                    $hasDogs = true;
                    echo "<div class='animal-card'>";
                    echo "<h4>" . (isset($row['Name']) ? htmlspecialchars($row['Name']) : 'Unknown') . "</h4>";
                    echo "<p><strong>Age:</strong> " . (isset($row['Age']) ? htmlspecialchars($row['Age']) : 'N/A') . "</p>";
                    echo "<p><strong>Sex:</strong> " . (isset($row['Sex']) ? htmlspecialchars($row['Sex']) : 'N/A') . "</p>";
                    echo "<p><strong>Size:</strong> " . (isset($row['Size']) ? htmlspecialchars($row['Size']) : 'N/A') . "</p>";
                    echo "<p><strong>Energy Level:</strong> " . (isset($row['Energy_Level']) ? htmlspecialchars($row['Energy_Level']) : 'N/A') . "</p>";
                    echo "<p><strong>Personality:</strong> " . (isset($row['Personality']) ? htmlspecialchars($row['Personality']) : 'N/A') . "</p>";
                    echo "<p><strong>Treatments:</strong> " . (isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : 'N/A') . "</p>";
                    echo "<p><strong>Rescue Date:</strong> " . (isset($row['Rescue_Date']) ? htmlspecialchars($row['Rescue_Date']) : 'N/A') . "</p>";
                    echo "<a href='apply.php?id=" . htmlspecialchars($row['ID']) . "' class='apply-button'>Adopt</a>";
                    echo "</div>";
                }
            }
            if (!$hasDogs) {
                echo "<p>No dogs found.</p>";
            }
            ?>

            <h3>Cats</h3>
            <?php
            $stmt->execute();
            $hasCats = false;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (isset($row['Animal_Type']) && strtolower($row['Animal_Type']) === 'cat') {
                    $hasCats = true;
                    echo "<div class='animal-card'>";
                    echo "<h4>" . (isset($row['Name']) ? htmlspecialchars($row['Name']) : 'Unknown') . "</h4>";
                    echo "<p><strong>Age:</strong> " . (isset($row['Age']) ? htmlspecialchars($row['Age']) : 'N/A') . "</p>";
                    echo "<p><strong>Sex:</strong> " . (isset($row['Sex']) ? htmlspecialchars($row['Sex']) : 'N/A') . "</p>";
                    echo "<p><strong>Size:</strong> " . (isset($row['Size']) ? htmlspecialchars($row['Size']) : 'N/A') . "</p>";
                    echo "<p><strong>Energy Level:</strong> " . (isset($row['Energy_Level']) ? htmlspecialchars($row['Energy_Level']) : 'N/A') . "</p>";
                    echo "<p><strong>Personality:</strong> " . (isset($row['Personality']) ? htmlspecialchars($row['Personality']) : 'N/A') . "</p>";
                    echo "<p><strong>Treatments:</strong> " . (isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : 'N/A') . "</p>";
                    echo "<p><strong>Rescue Date:</strong> " . (isset($row['Rescue_Date']) ? htmlspecialchars($row['Rescue_Date']) : 'N/A') . "</p>";
                    echo "<a href='apply.php?id=" . htmlspecialchars($row['ID']) . "' class='apply-button'>Adopt</a>";
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