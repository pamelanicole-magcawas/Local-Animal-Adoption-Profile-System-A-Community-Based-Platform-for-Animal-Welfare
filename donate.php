<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/donate.css">

    <script>
        function showMethod(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "donation_details.php?q=" + str, true);
            xmlhttp.send();

        }
    </script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="user_homepage.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="view_animals.php"><i class="fas fa-paw"></i> Our Animals</a></li>
            <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="report.php"><i class="fas fa-exclamation-circle"></i> Report</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="heading">
        <h2>Together for Animals</h2>
        <p>
        Your generous donation ensures that animals receive essential food, shelter, and medical care. Each contribution brings us closer to providing them with a better, safer life.
        </p>
    </div>

    <form method="POST" action="process_donation.php">
        Name: <input type="text" id="name" name="name" required>
        <br><br>
        Email: <input type="text" id="email" name="email" required>
        <br><br>
        Amount: <input type="number" id="donation_amount" name="donation_amount" required>
        <br><br>
        <div>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" onchange="showMethod(this.value)" required>
                <option value="">Select</option>
                <option value="PayMaya">PayMaya</option>
                <option value="GCash">GCash</option>
                <option value="Bank Transfer (BDO)">Bank Transfer (BDO)</option>
                <option value="Bank Transfer (Metrobank)">Bank Transfer (Metrobank)</option>
            </select>
        </div>
        <br><br>
        <div id="txtHint"><b>Payment details will be listed here...</b></div>
        <br><br>

        <input type="submit" value="Donate">
    </form>

    <footer>
        Copyright &copy; 2024 Animal Adoption Organization. All Rights Reserved.
    </footer>

</body>

</html>