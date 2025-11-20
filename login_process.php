<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Check if fields are empty
    if(empty($email) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Update last login time
            $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$user['id']]);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            
            // Log successful login attempt
            $logStmt = $pdo->prepare("INSERT INTO login_attempts (email, ip_address, success) VALUES (?, ?, TRUE)");
            $logStmt->execute([$email, $_SERVER['REMOTE_ADDR']]);

            header("Location: index.php");
            exit();
        } else {
            // Log failed login attempt
            $logStmt = $pdo->prepare("INSERT INTO login_attempts (email, ip_address, success) VALUES (?, ?, FALSE)");
            $logStmt->execute([$email, $_SERVER['REMOTE_ADDR']]);

            header("Location: login.php?error=invalid");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: login.php?error=server");
        exit();
    }
}
?> 