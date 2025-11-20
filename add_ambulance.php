<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_number = $_POST['vehicle_number'];
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $last_maintenance_date = $_POST['last_maintenance_date'];

    try {
        $stmt = $pdo->prepare("
            INSERT INTO ambulances (vehicle_number, model, capacity, last_maintenance_date)
            VALUES (?, ?, ?, ?)
        ");
        
        $stmt->execute([$vehicle_number, $model, $capacity, $last_maintenance_date]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        error_log("Error adding ambulance: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>