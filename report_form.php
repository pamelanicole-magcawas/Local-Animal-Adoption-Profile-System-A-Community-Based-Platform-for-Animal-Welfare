<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/reports.css">
    <title>Submit Report</title>
</head>

<body>
    <nav>
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

    <h1>Submit a Report</h1>
    <p>
        Whether you’re dealing with an emergency or simply need guidance, we’re here to help. Your request is important to us, and we’re committed to responding with the care and urgency it deserves. Our team is dedicated to delivering prompt, effective support to make sure you’re
        not alone during critical moments. Rest assured, we’re always ready to assist, no matter the situation. Together, we’ll ensure that help is on its way as quickly as possible—because your safety and well-being are our top priorities. Let us know how we can help you today!
    </p>

    <form action="process_report.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" required><br>

        <label for="message">Report Message:</label><br>
        <textarea name="message" id="message" required></textarea><br>

        <button type="submit">Submit Report</button>
    </form>

    <script>
        <?php
        // Check for status in URL and show SweetAlert
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo "Swal.fire({
                    icon: 'success',
                    title: 'Your report has been submitted successfully!',
                    showConfirmButton: true
                });";
            } elseif ($_GET['status'] == 'error') {
                echo "Swal.fire({
                    icon: 'error',
                    title: 'There was an error submitting your report.',
                    showConfirmButton: true
                });";
            }
        }
        ?>
    </script>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
</body>

</html>