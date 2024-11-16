<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#animaltable').DataTable();
        });
    </script>
</head>

<body>
    <h2>Animal List</h2>
    <form method="POST" action="create.php">
        Name: <input type="text" name="name" required>
        <br><br>
        Age: <input type="number" name="age" required>
        <br><br>
        Sex: <input type="text" name="sex" required>
        <br><br>
        Treatments: <input type="message" name="treatments" required>
        <br><br>
        <input type="submit" value="Create">
    </form>

    <h2>Lists</h2>
    <table id="animaltable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Treatments</th>
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

                if($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" .(isset($row['ID']) ? htmlspecialchars($row['ID']) : '') ."</td>";
                        echo "<td>" .(isset($row['Name']) ? htmlspecialchars($row['Name']) : '') ."</td>";
                        echo "<td>" .(isset($row['Age']) ? htmlspecialchars($row['Age']) : '') ."</td>";
                        echo "<td>" .(isset($row['Sex']) ? htmlspecialchars($row['Sex']) : '') ."</td>";
                        echo "<td>" .(isset($row['Treatments']) ? htmlspecialchars($row['Treatments']) : '') ."</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>

</html>