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
    <link rel="stylesheet" href="style/lists.css">
    <title>Animal List</title>
</head>

<body>
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
                    echo "<p><strong>Treatments:</strong> " . (isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : 'N/A') . "</p>";
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
                    echo "<p><strong>Treatments:</strong> " . (isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : 'N/A') . "</p>";
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
