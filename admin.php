<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Adoption Applications</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <h2>Adoption Applications</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Reason for Adoption</th>
            <th>Status</th>
            <th>Submission Date</th>
        </tr>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM applications";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['adoption_reason']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['submission_date']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
