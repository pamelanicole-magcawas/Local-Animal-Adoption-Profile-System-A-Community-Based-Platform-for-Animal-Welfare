<?php

    require_once 'dbConnect.php';
    require_once 'crud.php';

    $animal = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $database = new Database();
        $db = $database->getConnect();

        $animal = new Animal($db);
        $animal->name = htmlspecialchars(trim($_POST['name']));
        $animal->age = htmlspecialchars(trim($_POST['age']));
        $animal->sex = htmlspecialchars(trim($_POST['sex']));
        $animal->treatments = htmlspecialchars(trim($_POST['treatments']));
    }

    if ($animal && $animal->create()) {
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
            text: 'Data was successfully inserted!',
            icon: 'success'
        }).then((result) => { // Properly closes the Swal.fire function
            if (result.isConfirmed) {
            window.location.href = 'index.php';
            }
        });
        </script>


        </body>
        </html>";

    } else {
        echo 'Error!';
}
