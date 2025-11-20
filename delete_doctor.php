<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Check if doctor ID was provided
if (!isset($_POST['doctor_id'])) {
    echo json_encode(['success' => false, 'message' => 'No doctor specified']);
    exit;
}

$doctor_id = $_POST['doctor_id'];

try {
    // Start transaction
    $pdo->beginTransaction();

    // First delete all appointments for this doctor
    $stmt = $pdo->prepare("DELETE FROM appointments WHERE doctor_id = ?");
    $stmt->execute([$doctor_id]);

    // Then delete the doctor
    $stmt = $pdo->prepare("DELETE FROM doctors WHERE id = ?");
    $stmt->execute([$doctor_id]);

    // Commit transaction
    $pdo->commit();

    // Log the deletion
    error_log("Doctor ID {$doctor_id} and related appointments deleted by admin ID {$_SESSION['admin_id']}");
    
    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    error_log("Error deleting doctor: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?> 