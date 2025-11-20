<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ambulance_id = $_POST['ambulance_id'];
    $is_available = $_POST['is_available'] === 'true' ? 1 : 0;

    try {
        $stmt = $pdo->prepare("UPDATE ambulances SET is_available = ? WHERE id = ?");
        $stmt->execute([$is_available, $ambulance_id]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        error_log("Error updating ambulance status: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>