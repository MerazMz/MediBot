<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Check if appointment ID was provided
if (!isset($_POST['appointment_id'])) {
    echo json_encode(['success' => false, 'message' => 'No appointment specified']);
    exit;
}

$appointment_id = $_POST['appointment_id'];

try {
    // First check if the appointment exists
    $stmt = $pdo->prepare("SELECT id FROM appointments WHERE id = ?");
    $stmt->execute([$appointment_id]);
    
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Appointment not found']);
        exit;
    }

    // Delete the appointment
    $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->execute([$appointment_id]);

    // Log the deletion
    error_log("Appointment ID {$appointment_id} deleted by admin ID {$_SESSION['admin_id']}");
    
    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    error_log("Error deleting appointment: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?> 