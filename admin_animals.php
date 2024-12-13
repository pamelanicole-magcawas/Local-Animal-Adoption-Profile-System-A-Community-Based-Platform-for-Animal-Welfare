<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ensure that the admin is redirected to the correct dashboard
if ($_SESSION['username'] !== 'admin1') {
    header("Location: login.php"); // Redirect back if not admin1
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals</title>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="style/admin_animals.css">

    <script>
        $(document).ready(function() {
            $('#animaltable').DataTable();
        });
    </script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="admin_animals.php">Manage Animals</a></li>
            <li><a href="admin_reports.php">Manage Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h1>Create New Animal Profile</h1>
    <form method="POST" action="create.php">
        Name: <input type="text" name="name" required>
        <br><br>
        Age: <input type="number" name="age" required>
        <br><br>
        Sex: <input type="text" name="sex" required>
        <br><br>
        Treatments: <input type="text" name="treatments" required>
        <br><br>
        Type: <select name="animal_type" required>
            <option value=""></option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
        </select>
        <br><br>
        Size: <input type="text" name="size" required>
        <br><br>
        Energy Level: <input type="text" name="energy_level" required>
        <br><br>
        Personality: <input type="text" name="personality" required>
        <br><br>
        Rescue Date: <input type="date" id="rescue_date" name="rescue_date" required>
        <br><br>
        <input type="submit" value="Create">
    </form>

    <h2>List of Animals</h2>
    <table id="animaltable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Treatments</th>
                <th>Type</th>
                <th>Size</th>
                <th>Energy Level</th>
                <th>Personality</th>
                <th>Rescue Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'dbConnect.php';
            require_once 'crud.php';

            $database = new Database();
            $db = $database->getConnect();

            $animal = new Animal($db);
            $stmt = $animal->read();
            $num = $stmt->rowCount();

            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['id']) ? htmlspecialchars($row['id']) : '') . "</td>";
                    echo "<td>" . (isset($row['name']) ? htmlspecialchars($row['name']) : '') . "</td>";
                    echo "<td>" . (isset($row['age']) ? htmlspecialchars($row['age']) : '') . "</td>";
                    echo "<td>" . (isset($row['sex']) ? htmlspecialchars($row['sex']) : '') . "</td>";
                    echo "<td>" . (isset($row['treatments']) ? htmlspecialchars($row['treatments']) : '') . "</td>";
                    echo "<td>" . (isset($row['animal_type']) ? htmlspecialchars($row['animal_type']) : '') . "</td>";
                    echo "<td>" . (isset($row['size']) ? htmlspecialchars($row['size']) : '') . "</td>";
                    echo "<td>" . (isset($row['energy_level']) ? htmlspecialchars($row['energy_level']) : '') . "</td>";
                    echo "<td>" . (isset($row['personality']) ? htmlspecialchars($row['personality']) : '') . "</td>";
                    echo "<td>" . (isset($row['rescue_date']) ? htmlspecialchars($row['rescue_date']) : '') . "</td>";
                    echo "<td>" . (isset($row['status']) ? htmlspecialchars($row['status']) : '') . "</td>";
                    echo "<td class='actions'>
                        <form method='POST' action='edit_animals.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <input type='hidden' name='name' value='" . htmlspecialchars($row['name']) . "'>
                            <input type='hidden' name='age' value='" . htmlspecialchars($row['age']) . "'>
                            <input type='hidden' name='sex' value='" . htmlspecialchars($row['sex']) . "'>
                            <input type='hidden' name='treatments' value='" . htmlspecialchars($row['treatments']) . "'>
                            <input type='hidden' name='animal_type' value='" . htmlspecialchars($row['animal_type']) . "'>
                            <input type='hidden' name='size' value='" . htmlspecialchars($row['size']) . "'>
                            <input type='hidden' name='energy_level' value='" . htmlspecialchars($row['energy_level']) . "'>
                            <input type='hidden' name='personality' value='" . htmlspecialchars($row['personality']) . "'>
                            <input type='hidden' name='rescue_date' value='" . htmlspecialchars($row['rescue_date']) . "'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form method='POST' action='delete_animals.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <input type='submit' value='Delete'>
                        </form>
                        </td> ";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <br><br>
    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>