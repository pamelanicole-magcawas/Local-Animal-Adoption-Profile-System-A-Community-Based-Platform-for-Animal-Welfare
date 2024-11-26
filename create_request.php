<?php
require_once 'dbConnect.php';  
require_once 'emergency_request.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database(); 
    $db = $database->getConnect(); 

    $emergencyRequest = new EmergencyRequest($db);

    $emergencyRequest->user_name = htmlspecialchars(trim($_POST['user_name']));
    $emergencyRequest->user_email = htmlspecialchars(trim($_POST['user_email']));
    $emergencyRequest->user_phone = htmlspecialchars(trim($_POST['user_phone']));
    $emergencyRequest->emergency_message = htmlspecialchars(trim($_POST['emergency_message']));

    $emergency_message = $emergencyRequest->emergency_message;

    if ($emergencyRequest->create()) {
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
            title: 'Success!',
            html: `Thank you for submitting your emergency request. We have received the following details:
            <br><br>
            <strong>Emergency Message:</strong><br>
            {$emergency_message}<br><br>
            Our team will contact you shortly for further assistance.<br><br>
            <strong>Best regards,<br>Animal Care Team</strong>`,
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'emergency_request_form.php'; // Redirect
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
