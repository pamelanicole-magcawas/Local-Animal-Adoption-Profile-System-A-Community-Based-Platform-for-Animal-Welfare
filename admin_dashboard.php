<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Animal Adoption</title>
    <link rel="stylesheet" href="style/admin_dashboard.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="manage_animals.php">Manage Animals</a></li>
            <li><a href="manage_adoptions.php">Manage Adoptions</a></li>
            <li><a href="manage_donations.php">Manage Donations</a></li>
            <li><a href="manage_reports.php">Manage Reports</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="welcome">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Take control of the animal adoption process and make a positive impact.</p>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Manage Animals</h3>
                <p>Add, edit, or remove animals available for adoption.</p>
                <a href="manage_animals.php">Go to Animals</a>
            </div>
            <div class="card">
                <h3>Manage Adoptions</h3>
                <p>Track and manage all adoption requests.</p>
                <a href="manage_adoptions.php">Go to Adoptions</a>
            </div>
            <div class="card">
                <h3>Manage Donations</h3>
                <p>View and manage donations to your organization.</p>
                <a href="manage_donations.php">Go to Donations</a>
            </div>
            <div class="card">
                <h3>Manage Reports</h3>
                <p>View and manage user-submitted reports regarding concerns, issues, or emergencies.</p>
                <a href="manage_reports.php">Go to Reports</a>
            </div>
        </div>
    </div>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>
