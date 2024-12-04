<?php
// papaltan Database class
require_once 'db_donation.php';
require_once 'donations.php';

$database = new Database();
$conn = $database->getConnect();

// papaltan ng table name
$query = "SELECT * FROM donationtable";
$stmt = $conn->prepare($query);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h1>Users List</h1>

    <?php if (count($users) > 0): ?>
        <?php foreach ($users as $user): ?>
            <div>
                <h2><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No users found in the database.</p>
    <?php endif; ?>
</body>
</html>