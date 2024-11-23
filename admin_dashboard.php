<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Animal Adoption</title>
    <link rel="stylesheet" href="dashboard.css">

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
        </div>
    </div>
</body>
</head>

</html>
