<?php
session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        throw new Exception('Invalid data received');
    }

    // Store in session
    $_SESSION['google_id'] = $data['google_id'];
    $_SESSION['user_name'] = $data['name'];
    $_SESSION['user_email'] = $data['email'];

    // Check if user exists in database
    $stmt = $pdo->prepare("SELECT id FROM users WHERE google_id = ?");
    $stmt->execute([$data['google_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (google_id, fullname, email, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([
            $data['google_id'],
            $data['name'],
            $data['email']
        ]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
    } else {
        $_SESSION['user_id'] = $user['id'];
        // Update last login
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}