<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form fields
    $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $adoption_reason = $_POST['adoption_reason'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO applications (name, email, phone, address, adoption_reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $adoption_reason);

    // Execute and check for success
    if ($stmt->execute()) {
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
            title: 'Success!',
            text: 'Data was Updated successfully!',
            icon: 'info'
            }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'apply.php';
            }
            });
        </script>
        </body>
        </html> ";
    } else {
        echo
        "
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
            title: 'Error!',
            text: 'Error when updating!',
            icon: 'info'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'apply.php';
            }
        });
        </script>
        </body>
        </html> ";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
