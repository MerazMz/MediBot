<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ambulance_id'])) {
    $ambulance_id = $_POST['ambulance_id'];

    try {
        $pdo->beginTransaction();

        // Delete related bookings first
        $stmt = $pdo->prepare("DELETE FROM ambulance_bookings WHERE ambulance_id = ?");
        $stmt->execute([$ambulance_id]);

        // Then delete the ambulance
        $stmt = $pdo->prepare("DELETE FROM ambulances WHERE id = ?");
        $stmt->execute([$ambulance_id]);

        $pdo->commit();
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        $pdo->rollBack();
        error_log("Error deleting ambulance: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>