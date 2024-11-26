<?php
require_once 'dbConnect.php';
require_once 'crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnect();

    $animal = new Animal($db);
    $animal->id = htmlspecialchars(trim($_POST['id']));
    $animal->name = htmlspecialchars(trim($_POST['name']));
    $animal->age = htmlspecialchars(trim($_POST['age']));
    $animal->sex = htmlspecialchars(trim($_POST['sex']));
    $animal->treatments = htmlspecialchars(trim($_POST['treatments']));
    $animal->animal_type = htmlspecialchars(trim($_POST['animal_type']));
    $animal->size = htmlspecialchars($_POST['size']);
    $animal->energy_level = htmlspecialchars($_POST['energy_level']);
    $animal->personality = htmlspecialchars($_POST['personality']);
    $animal->rescue_date = htmlspecialchars($_POST['rescue_date']);

    if ($animal->update()) {
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
                window.location.href = 'manage_animals.php';
            }
            });
        </script>
        </body>
        </html> ";
    } else {
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
                window.location.href = 'manage_animals.php';
            }
        });
        </script>

        </body>
        </html> ";
    }
}
?>