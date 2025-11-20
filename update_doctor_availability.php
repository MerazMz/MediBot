<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Check if required parameters are provided
if (!isset($_POST['doctor_id']) || !isset($_POST['is_available'])) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$doctor_id = $_POST['doctor_id'];
$is_available = $_POST['is_available'] === 'true' ? 1 : 0;

try {
    // Update doctor availability
    $stmt = $pdo->prepare("UPDATE doctors SET is_available = ? WHERE id = ?");
    $stmt->execute([$is_available, $doctor_id]);

    // Log the update
    $status = $is_available ? 'available' : 'unavailable';
    error_log("Doctor ID {$doctor_id} status updated to {$status} by admin ID {$_SESSION['admin_id']}");
    
    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    error_log("Error updating doctor availability: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?> 