<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Check if appointment ID was provided
if (!isset($_POST['appointment_id'])) {
    echo json_encode(['success' => false, 'message' => 'No appointment specified']);
    exit;
}

$appointment_id = $_POST['appointment_id'];
$user_id = $_SESSION['user_id'];

try {
    // First check if the appointment belongs to the user
    $stmt = $pdo->prepare("
        SELECT id, status 
        FROM appointments 
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([$appointment_id, $user_id]);
    $appointment = $stmt->fetch();

    if (!$appointment) {
        echo json_encode(['success' => false, 'message' => 'Appointment not found']);
        exit;
    }

    if ($appointment['status'] === 'cancelled') {
        echo json_encode(['success' => false, 'message' => 'Appointment is already cancelled']);
        exit;
    }

    // Update the appointment status to cancelled
    $stmt = $pdo->prepare("
        UPDATE appointments 
        SET status = 'cancelled' 
        WHERE id = ? AND user_id = ?
    ");
    $stmt->execute([$appointment_id, $user_id]);

    echo json_encode(['success' => true]);

} catch(PDOException $e) {
    error_log("Error cancelling appointment: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?> 