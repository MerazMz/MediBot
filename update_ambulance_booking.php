<?php
session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];

    try {
        $pdo->beginTransaction();

        // Update booking status
        $stmt = $pdo->prepare("
            UPDATE ambulance_bookings 
            SET status = ? 
            WHERE id = ?
        ");
        $stmt->execute([$status, $booking_id]);

        // If completed or cancelled, make ambulance available again
        if ($status === 'completed' || $status === 'cancelled') {
            $stmt = $pdo->prepare("
                UPDATE ambulances a
                JOIN ambulance_bookings ab ON a.id = ab.ambulance_id
                SET a.is_available = 1
                WHERE ab.id = ?
            ");
            $stmt->execute([$booking_id]);
        }

        $pdo->commit();
        echo json_encode(['success' => true]);

    } catch(PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log("Error updating ambulance booking: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>