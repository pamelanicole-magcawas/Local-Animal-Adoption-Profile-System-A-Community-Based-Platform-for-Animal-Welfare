<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Request Form</title>
    <link rel="stylesheet" href="style/reports.css">
</head>
<body>
    <div class="heading">
        <h2>Need Assistance?</h2>
        <p>
        Whether you’re dealing with an emergency or simply need guidance, we’re here to help. Your request is important to us, and we’re committed to responding with the care and urgency it deserves. Our team is dedicated to delivering prompt, effective support to make sure you’re 
        not alone during critical moments. Rest assured, we’re always ready to assist, no matter the situation. Together, we’ll ensure that help is on its way as quickly as possible—because your safety and well-being are our top priorities. Let us know how we can help you today!
        </p>
    </div>

    <form action="create_request.php" method="POST">
        <label for="user_name">Name:</label>
        <input type="text" name="user_name" id="user_name" required><br>

        <label for="user_email">Email:</label>
        <input type="email" name="user_email" id="user_email" required><br>

        <label for="user_phone">Phone:</label>
        <input type="text" name="user_phone" id="user_phone" required><br>

        <label for="emergency_message">Message:</label><br>
        <textarea name="emergency_message" id="emergency_message" required></textarea><br>

        <button type="submit">Report</button>
    </form>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>
    
</body>

</html>