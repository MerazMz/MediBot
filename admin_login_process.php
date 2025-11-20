<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header("Location: admin_login.php?error=empty");
        exit();
    }

    try {
        // Check if admin exists using email or username
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? OR username = ?");
        $stmt->execute([$username, $username]);
        $admin = $stmt->fetch();

        if (!$admin) {
            error_log("Admin login failed: Email/Username not found - " . $username);
            header("Location: admin_login.php?error=invalid");
            exit();
        }

        // Verify password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Log successful login
            error_log("Admin login successful: " . $username);
            
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Log failed password attempt
            error_log("Admin login failed: Invalid password for email/username - " . $username);
            header("Location: admin_login.php?error=invalid");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Admin login error: " . $e->getMessage());
        header("Location: admin_login.php?error=server");
        exit();
    }
} else {
    header("Location: admin_login.php");
    exit();
}
?> 