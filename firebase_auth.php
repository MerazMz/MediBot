<?php
session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

try {
    // Get the POST data
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Invalid data received');
    }

    // Check if user already exists
    $stmt = $pdo->prepare("SELECT id, fullname FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    $user = $stmt->fetch();

    if ($user) {
        // Update existing user's last login
        $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $updateStmt->execute([$user['id']]);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $data['email'];
    } else {
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, profile_image, created_at) VALUES (?, ?, ?, ?, NOW())");
        // Generate a random secure password for Google users
        $random_password = bin2hex(random_bytes(16));
        $hashed_password = password_hash($random_password, PASSWORD_DEFAULT);
        
        $stmt->execute([
            $data['name'],
            $data['email'],
            $hashed_password,
            $data['profile_image']
        ]);

        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $data['name'];
        $_SESSION['user_email'] = $data['email'];
    }

    // Log the successful login
    $logStmt = $pdo->prepare("INSERT INTO login_attempts (email, ip_address, success) VALUES (?, ?, TRUE)");
    $logStmt->execute([$data['email'], $_SERVER['REMOTE_ADDR']]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    error_log("Firebase Auth Error: " . $e->getMessage());
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}