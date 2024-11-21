<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption</title>
    <link rel="stylesheet" href="status.css">
</head>
<body>

    <nav class = "port">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="#">OUR ANIMALS</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
        </ul>
    </nav>

    <header class = "sonic">
        <p>Your generous donation helps provide food, shelter, and medical care to animals in need. Every contribution makes a difference and brings us closer to giving them a better life.</p>

    </header>

    <form method="POST" action="process_donation.php">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>
    <br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>
    <br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>

    <label for="donation_amount">Amount:</label>
    <input type="number" id="donation_amount" name="donation_amount" step="0.01" required>
    <br><br>

    <label for="payment_method">Payment Method:</label>
    <select id="payment_method" name="payment_method" required>
        <option value="PayPal">PayPal</option>
        <option value="GCash">GCash</option>
        <option value="Bank Transfer">Bank Transfer</option>
    </select>
    <br><br>

    <input type="submit" value="Donate">
</form>


</body>
</html>