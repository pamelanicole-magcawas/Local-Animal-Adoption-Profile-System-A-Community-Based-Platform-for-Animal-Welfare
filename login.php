<?php
session_start();
include 'dbConnect.php';

$database = new Database();
$pdo = $database->getConnect();

// Admin usernames, passwords (hashed), and permissions
$admins = [
    'admin1' => [
        'password' => password_hash('admin1', PASSWORD_DEFAULT),
        'permissions' => ['manage_animals', 'manage_reports']
    ],
    'admin2' => [
        'password' => password_hash('admin2', PASSWORD_DEFAULT),
        'permissions' => ['manage_adoptions']
    ],
    'admin3' => [
        'password' => password_hash('admin3', PASSWORD_DEFAULT),
        'permissions' => ['manage_donations', 'manage_users']
    ]
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists and the password is correct for admins
    if (array_key_exists($username, $admins) && password_verify($password, $admins[$username]['password'])) {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $username;
        $_SESSION['permissions'] = $admins[$username]['permissions']; // Store admin permissions in session

        // Redirect to a common admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username AND role = 'user'");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['role'] = 'user';
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['id'];
                header("Location: user_homepage.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
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
    <link rel="stylesheet" href="style/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1 class="form-title">Login</h1>
        <form method="POST" action="login.php">
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
            <input type="submit" class="btn" value="Login">
            <p class="or">----------or----------</p>
            <div class="links">
                <p>Don't Have An Account?</p>
                <a href="signup.php" id="signUpLink">Sign Up</a>
            </div>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
