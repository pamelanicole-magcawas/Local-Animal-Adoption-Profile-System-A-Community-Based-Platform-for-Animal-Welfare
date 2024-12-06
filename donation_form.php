<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$alertType = isset($_SESSION['alertType']) ? $_SESSION['alertType'] : '';
$alertMessage = isset($_SESSION['alertMessage']) ? $_SESSION['alertMessage'] : '';

unset($_SESSION['alertType']);
unset($_SESSION['alertMessage']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/donate_form.css">
    <title>Donate</title>
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

    <div class="content">
        <h1>Donate to Support Our Cause</h1>
        <form action="process_donation.php" method="POST">
            <p>
                <span style="color: green; font-weight: bold;">Account Name:</span>
                <span style="color: black;">Pawsitive Change PH</span><br>
                <span style="color: green; font-weight: bold;">Account Number:</span>
                <span style="color: black;">0917-765-4321</span>
            </p>
            <img src="img/qr.jpg" alt="QR Code">
            <p>*Include donation purpose (e.g., "Animal Rescue").*</p>
            <p>*You may send a proof of donation (e.g., screenshot or deposit slip) to our official email at [receipts@pawsitivechangeph.com] or contact number [0921-456-7890] for acknowledgment and any inquiries.*</p>
            <label for="amount">Donation Amount:</label>
            <input type="number" name="amount" id="amount" required min="1" step="0.01">
            <br>
            <label for="message">Message:</label>
            <textarea name="message" id="message" required maxlength="255"></textarea>
            <br>
            <button type="submit">Donate</button>
        </form>
    </div>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>

    <?php if (!empty($alertType) && !empty($alertMessage)): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $alertType; ?>', // 'success' or 'error'
                title: '<?php echo $alertMessage; ?>',
                showConfirmButton: true,
            });
        </script>
    <?php endif; ?>
</body>

</html>