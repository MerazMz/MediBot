<?php
session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    try {
        $pdo->beginTransaction();

        // First, get the ambulance ID to update its availability
        $stmt = $pdo->prepare("SELECT ambulance_id FROM ambulance_bookings WHERE id = ?");
        $stmt->execute([$booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($booking) {
            // Update ambulance availability to available
            $stmt = $pdo->prepare("UPDATE ambulances SET is_available = 1 WHERE id = ?");
            $stmt->execute([$booking['ambulance_id']]);
        }

        // Then delete the booking
        $stmt = $pdo->prepare("DELETE FROM ambulance_bookings WHERE id = ?");
        $stmt->execute([$booking_id]);

        $pdo->commit();
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        $pdo->rollBack();
        error_log("Error deleting ambulance booking: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>