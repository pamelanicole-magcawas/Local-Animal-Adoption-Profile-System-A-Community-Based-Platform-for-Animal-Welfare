<?php
require_once 'dbConnect.php';
require_once 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnect();
    $animal = new Animal($db);
    $animal->id = htmlspecialchars(trim($_POST['id']));
    if ($animal->delete()) {
        echo  "
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
            title: 'Delete',
            text: 'Animal deleted successfully',
            icon: 'success'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'admin_animals.php';
            }
        });
        </script>
            
        </body>
        </html> ";
    } else {
        echo  "
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
            text: 'Error Deleting!',
            icon: 'info'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'admin_animals.php';
            }
        });
        </script>
            
        </body>
        </html> ";
    }
}
?>