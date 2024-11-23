<?php
require_once 'dbConnect.php';
require_once 'crud.php';

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $sex = htmlspecialchars($_POST['sex']);
    $treatments = htmlspecialchars($_POST['treatments']);
    $animal_type = htmlspecialchars($_POST['animal_type']);
    $size = htmlspecialchars($_POST['size']);
    $energy_level = htmlspecialchars($_POST['energy_level']);
    $personality = htmlspecialchars($_POST['personality']);
    $rescue_date = htmlspecialchars($_POST['rescue_date']);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal Informations</title>
    <link rel="stylesheet" href="style/edit.css">
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

    <h2>Edit Animals</h2>
    <form method="POST" action="update_animals.php">
    <input type="hidden" name ="id" value="<?php echo $id; ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br><br>
        Age: <input type="number" name="age" value="<?php echo $age; ?>" required>
        <br><br>
        Sex: <input type="text" name="sex" value="<?php echo $sex; ?>" required>
        <br><br>
        Treatments: <input type="text" name="treatments" value="<?php echo $treatments; ?>" required>
        <br><br>
        <label for="animal_type">Animal Type:</label>
        <select id="animal_type" name="animal_type" required>
            <option value=""></option>
            <option value="Dog" <?php echo ($animal_type == 'Dog') ? 'selected' : ''; ?>>Dog</option>
            <option value="Cat" <?php echo ($animal_type == 'Cat') ? 'selected' : ''; ?>>Cat</option>
        </select>
        <br><br>
        Size: <input type="text" name="size" value="<?php echo $size; ?>" required>
        <br><br>
        Energy Level: <input type="text" name="energy_level" value="<?php echo $energy_level; ?>" required>
        <br><br>
        Personality: <input type="text" name="personality" value="<?php echo $personality; ?>" required>
        <br><br>
        Rescue Date: <input type="date" name="rescue_date" value="<?php echo $rescue_date; ?>" required>
        <br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>