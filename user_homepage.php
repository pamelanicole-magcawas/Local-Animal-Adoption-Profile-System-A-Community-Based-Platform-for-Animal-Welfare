<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


include 'tips.php';

$tipGenerator = new AllTipsGenerator();
$randomTip = $tipGenerator->getRandomTip();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/user_homepage.css">
    <title>Animal Shelter</title>
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

    <main>
        <section class="welcome-section">
            <h1>WELCOME</h1>
        </section>

        <section class="animal-tip">
            <h2>Animal Care Tip</h2>
            <p><?php echo $randomTip; ?></p>
        </section>

        <div class="cards-container">
            <div class="card faq">
                <h2>Did you know?</h2>
                <p>Adopting a pet saves lives! There are millions of animals in need of a loving home. By choosing to adopt, you're giving a furry friend a second chance at happiness.</p>
                <button><a href="faq.php">Adoption FAQ</a></button>
            </div>
        </div> 
    </main>
</body>

</html>