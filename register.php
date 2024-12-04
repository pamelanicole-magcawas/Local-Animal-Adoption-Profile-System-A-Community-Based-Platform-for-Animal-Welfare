<?php
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = sanitize_input($_POST["fName"]);
    $email = sanitize_input($_POST["email"]);
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    $errors = [];

    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors[] = "Email already exists";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $password_confirmation) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$full_name, $email, $password_hash])) {
            set_flash_message('success', "Registration successful. You can now log in.");
            header("Location: index.php");
            exit;
        } else {
            set_flash_message('danger', "Registration failed. Please try again.");
        }
    } else {
        set_flash_message('danger', implode("<br>", $errors));
    }
}

// Redirect to index.php after processing
header("Location: index.php");
exit(); 
