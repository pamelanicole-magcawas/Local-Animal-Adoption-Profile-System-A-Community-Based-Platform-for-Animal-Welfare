<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoption Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>ADOPTION APPLICATION</h1>
        <p class="note">* indicates required fields</p>
        
        <h2>APPLICANT'S INFO</h2>
        <form action="submit_application.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="first-name">Name *</label>
                    <div class="name-field">
                        <input type="text" id="first-name" name="first_name" placeholder="First" required>
                        <input type="text" id="last-name" name="last_name" placeholder="Last">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="address">Address *</label>
                    <input type="text" id="address" name="address" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone *</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="adoption_reason">Reason for Adoption *</label>
                    <textarea id="adoption_reason" name="adoption_reason" required></textarea>
                </div>
            </div>

            <button type="submit">Submit Application</button>
        </form>
    </div>
</body>
</html>
