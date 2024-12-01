<?php
session_start();
include("database.php");

$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
        <h1>Home</h1>
        <?php if ($user): ?>
            <p>Hello <?= htmlspecialchars($user["FName"] . " " . $user["LName"]) ?></p>
            <p><a href="logout.php">Log out</a></p>
        <?php else: ?>
            <p><a href="index.php">Log in</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
