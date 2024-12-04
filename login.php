<?php
require_once 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = $_POST["password"];
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id, full_name, email, password_hash FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Login successful - Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];

            set_flash_message('success', "Login successful. Welcome back, {$user['full_name']}!");
            header("Location: user_homepage.php");
            exit;
        } else {
            $errors[] = "Invalid email or password";
        }
    }

    if (!empty($errors)) {
        set_flash_message('danger', implode("<br>", $errors));
        header("Location: index.php");
        exit;
    }
}

header("Location: index.php");
exit();
