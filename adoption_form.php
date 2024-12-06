<?php
require_once 'dbConnect.php';
require_once 'crud.php';

if (!isset($_GET['animal_id'])) {
    die("Invalid request.");
}

$animal_id = $_GET['animal_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/adoptions_form.css">
    <title>Adoption Form</title>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="user_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="view_animals.php"><i class="fas fa-paw"></i> Our Animals</a></li>
            <li><a href="donation_form.php"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="pet_services.php"><i class="fas fa-band-aid"></i> Pet Care Services</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="report_form.php"><i class="fas fa-exclamation-circle"></i> Report</a></li>
            <li><a href="dashboard.php"><i class="fas fa-user"></i> Dashboard</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <h1>Adoption Form</h1>

    <div class="container">
        <p class="note">* indicates required fields</p>
        <form action="submit_adoption_request.php" method="post">
            <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal_id); ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <br>
            <label for="user_contact">Contact Information: *</label>
            <input type="text" id="user_contact" name="user_contact" required>
            <br>
            <label for="email">Email: *</label>
            <input type="text" id="email" name="email" required>
            <br>
            <h2>QUESTIONNAIRE</h2>
            <label for="vet_name">Do you have a veterinarian? If yes, please provide their name: *</label>
            <input type="text" id="vet_name" name="vet_name" required>
            <br>
            <label for="exercise_plan">Describe your plan for exercising and socializing the pet: *</label>
            <textarea id="exercise_plan" name="exercise_plan" required></textarea>
            <br>
            <label for="emergency_care">Are you prepared to provide emergency medical care if needed? *</label>
            <select id="emergency_care" name="emergency_care" required>
                <option value="">Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <br><br>
            <button type="submit">Submit Request</button>
        </form>
    </div>
</body>

</html>