<?php
$title = "Pet Adoption Center";
$adoptionSteps = [
    "Submit the adoption application form",
    "Attend the Zoom interview",
    "Meet our shelter animals in person",
    "Visit your chosen pet to confirm your choice",
    "Wait for vet clearance and schedule pickup",
    "Pay the adoption fee of ₱500 (cat) / ₱1000 (dog)",
    "Take your pet home!"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="logo.png" alt="Pet Adoption Logo" class="logo">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#adopt">Adopt</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home" class="banner">
            <div class="content">
                <h1>Adopt a Shelter Cat or Dog</h1>
                <p>Our adoptable cats and dogs are all spayed/neutered (<i>kapon</i>) and vaccinated. Because they lived a difficult life before being rescued, we need to ensure they get adopted by loving humans and won't be subjected to further cruelty or neglect.</p>
            </div>
        </section>
        <section id="adopt" class="adoption-process">
            <h2>How to Apply:</h2>
            <ul>
                <?php foreach ($adoptionSteps as $index => $step): ?>
                    <li>
                        <i class="fas fa-paw"></i>
                        <span><?php echo $step; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="cta-buttons">
                <a href="apply.php" class="btn btn-primary">Apply Now</a>
                <a href="info.php" class="btn btn-secondary">Adoption FAQ</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Pet Paw Center. All rights reserved.</p>
    </footer>
</body>
</html>