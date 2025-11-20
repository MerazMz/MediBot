<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Check if required parameters are provided
if (!isset($_POST['appointment_id']) || !isset($_POST['status'])) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$appointment_id = $_POST['appointment_id'];
$status = $_POST['status'];

// Validate status
if (!in_array($status, ['confirmed', 'cancelled', 'completed'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit;
}

try {
    // Get current appointment status
    $checkStmt = $pdo->prepare("SELECT status FROM appointments WHERE id = ?");
    $checkStmt->execute([$appointment_id]);
    $currentStatus = $checkStmt->fetchColumn();

    // Validate status transition
    $validTransition = true;
    if ($status === 'completed' && $currentStatus !== 'confirmed') {
        $validTransition = false;
    }

    if (!$validTransition) {
        echo json_encode(['success' => false, 'message' => 'Invalid status transition']);
        exit;
    }

    // Update the appointment status
    $stmt = $pdo->prepare("
        UPDATE appointments 
        SET 
            status = ?,
            completed_at = CASE WHEN ? = 'completed' THEN CURRENT_TIMESTAMP ELSE NULL END
        WHERE id = ?
    ");
    $stmt->execute([$status, $status, $appointment_id]);

    // Log the status change
    error_log("Appointment ID {$appointment_id} status updated to {$status} by admin ID {$_SESSION['admin_id']}");
    
    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    error_log("Error updating appointment: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?>