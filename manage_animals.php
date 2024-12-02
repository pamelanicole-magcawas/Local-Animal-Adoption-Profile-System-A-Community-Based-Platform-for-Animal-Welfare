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

    <link rel="stylesheet" href="style/animal.css">

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
            <li><a href="manage_animals.php">Manage Animals</a></li>
            <li><a href="manage_adoptions.php">Manage Adoptions</a></li>
            <li><a href="manage_donations.php">Manage Donations</a></li>
            <li><a href="manage_reports.php">Manage Reports</a></li>
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
        Status: <input type="text" id="status" name="status" required>
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
                    echo "<td>" . (isset($row['ID']) ? htmlspecialchars($row['ID']) : '') . "</td>";
                    echo "<td>" . (isset($row['Name']) ? htmlspecialchars($row['Name']) : '') . "</td>";
                    echo "<td>" . (isset($row['Age']) ? htmlspecialchars($row['Age']) : '') . "</td>";
                    echo "<td>" . (isset($row['Sex']) ? htmlspecialchars($row['Sex']) : '') . "</td>";
                    echo "<td>" . (isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : '') . "</td>";
                    echo "<td>" . (isset($row['Animal_Type']) ? htmlspecialchars($row['Animal_Type']) : '') . "</td>";
                    echo "<td>" . (isset($row['Size']) ? htmlspecialchars($row['Size']) : '') . "</td>";
                    echo "<td>" . (isset($row['Energy_Level']) ? htmlspecialchars($row['Energy_Level']) : '') . "</td>";
                    echo "<td>" . (isset($row['Personality']) ? htmlspecialchars($row['Personality']) : '') . "</td>";
                    echo "<td>" . (isset($row['Rescue_Date']) ? htmlspecialchars($row['Rescue_Date']) : '') . "</td>";
                    echo "<td>" . (isset($row['Status']) ? htmlspecialchars($row['Status']) : '') . "</td>";
                    echo "<td class='actions'>
                        <form method='POST' action='edit_animals.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                            <input type='hidden' name='name' value='" . htmlspecialchars($row['Name']) . "'>
                            <input type='hidden' name='age' value='" . htmlspecialchars($row['Age']) . "'>
                            <input type='hidden' name='sex' value='" . htmlspecialchars($row['Sex']) . "'>
                            <input type='hidden' name='treatments' value='" . htmlspecialchars($row['Treatments']) . "'>
                            <input type='hidden' name='animal_type' value='" . htmlspecialchars($row['Animal_Type']) . "'>
                            <input type='hidden' name='size' value='" . htmlspecialchars($row['Size']) . "'>
                            <input type='hidden' name='energy_level' value='" . htmlspecialchars($row['Energy_Level']) . "'>
                            <input type='hidden' name='personality' value='" . htmlspecialchars($row['Personality']) . "'>
                            <input type='hidden' name='rescue_date' value='" . htmlspecialchars($row['Rescue_Date']) . "'>
                            <input type='hidden' name='status' value='" . htmlspecialchars($row['Status']) . "'>
                            <input type='submit' value='Edit'>
                        </form>
                        <form method='POST' action='delete_animals.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                            <input type='submit' value='Delete'>
                        </form>
                        </td> ";
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