<?php
require_once 'db_donation.php';
require_once 'donations.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnect();

    $donations = new Donations($db);
    $donations->name = htmlspecialchars(trim($_POST['name']));
    $donations->email = htmlspecialchars(trim($_POST['email']));
    $donations->donation_amount = htmlspecialchars(trim($_POST['donation_amount']));
    $donations->payment_method = htmlspecialchars(trim($_POST['payment_method'])); 

    if ($donations->processDonation()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Donation Successful!',
            text: 'You’ve Made a Paw-sitive Difference!',
            icon: 'success'
        }).then(() => {
            window.location.href = 'donate.php';
        });
        </script>";
    } else {
        echo "
        <script>
        Swal.fire({
            title: 'Error!',
            text: 'Unable to process your donation. Please try again.',
            icon: 'error'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'donate.php';
            }
        });
        </script>

        </body>
        </html> ";
    }
}
?>
