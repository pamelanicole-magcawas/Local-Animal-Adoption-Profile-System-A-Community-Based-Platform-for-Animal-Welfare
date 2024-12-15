<?php
session_start();
require_once('dbConnect.php');

$db = new Database();
$conn = $db->getConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use the correct input field names
    $full_name = $_POST['full_name'];  // Corrected to match the form field name
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // Check if the username exists
    $query = "SELECT id FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        $error = "Username already exists!";
    } else {
        // Check if the email exists
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $error = "Email already exists!";
        } else {
            // Insert new user
            $query = "INSERT INTO users (full_name, email, username, password, role) VALUES (:full_name, :email, :username, :password, 'user')";
            $stmt = $conn->prepare($query);
            $stmt->execute([
                'full_name' => $full_name,
                'email' => $email,
                'username' => $username,
                'password' => $password
            ]);

            // Store user session data
            $_SESSION['email'] = $email;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['username'] = $username; // Store the username in the session

            // Redirect to login page
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/signup.css">
    <title>Signup</title>
</head>

<body>
    <div class="container" id="signup">
        <h1 class="form-title">SIGN UP</h1>
        <form method="post" action="signup.php" id="signupForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <!-- Corrected the name to 'full_name' to match PHP code -->
                <input type="text" name="full_name" id="fullName" placeholder="Full Name" required>
                <label for="fullName">Full Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signUpEmail" placeholder="Email" required>
                <label for="signUpEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
            <div class="links">
                <a href="login.php" id="signUpLink">Login</a>
            </div>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
        </form>
    </div>

</body>

</html>
