<?php
require_once 'dbConnect.php';  
require_once 'assistance_request.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database(); 
    $db = $database->getConnect(); 

    $assistanceRequest = new AssistanceRequest($db);

    $assistanceRequest ->user_name = htmlspecialchars(trim($_POST['user_name']));
    $assistanceRequest ->user_email = htmlspecialchars(trim($_POST['user_email']));
    $assistanceRequest ->user_phone = htmlspecialchars(trim($_POST['user_phone']));
    $assistanceRequest ->emergency_message = htmlspecialchars(trim($_POST['emergency_message']));

    if ($assistanceRequest ->createInquiry()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Report Sent!',
            text: 'Our team will contact you shortly for further assistance.',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'report.php'; // Redirect
            }
        });
        </script>
        </body>
        </html>";
    } else {
        echo 'Error! There was an issue with your request submission.';
    }
}
?>
