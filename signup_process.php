<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Check if fields are empty
    if(empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: signup.php?error=empty");
        exit();
    }

    // Validate email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=invalid_email");
        exit();
    }

    // Check password length
    if(strlen($password) < 6) {
        header("Location: signup.php?error=password_length");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: signup.php?error=password_mismatch");
        exit();
    }

    try {
        // Check if email already exists
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->execute([$email]);
        if($checkStmt->fetch()) {
            header("Location: signup.php?error=email_exists");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$fullname, $email, $hashed_password]);

        header("Location: login.php?success=registered");
        exit();
    } catch(PDOException $e) {
        error_log("Signup error: " . $e->getMessage());
        header("Location: signup.php?error=server");
        exit();
    }
}
?> 