<?php
session_start();
require_once 'db_connect.php';

// Get JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

try {
    // Find available ambulance with vehicle details
    $stmt = $pdo->query("SELECT id, vehicle_number, model FROM ambulances WHERE is_available = 1 LIMIT 1");
    $ambulance = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ambulance) {
        echo json_encode(['success' => false, 'message' => 'No ambulances available']);
        exit();
    }

    // Insert booking with location
    $stmt = $pdo->prepare("
        INSERT INTO ambulance_bookings (user_id, ambulance_id, booking_time, status, location) 
        VALUES (?, ?, NOW(), 'confirmed', ?)
    ");
    $stmt->execute([
        $_SESSION['user_id'],
        $ambulance['id'],
        $data['address']
    ]);

    // Update ambulance availability
    $stmt = $pdo->prepare("UPDATE ambulances SET is_available = 0 WHERE id = ?");
    $stmt->execute([$ambulance['id']]);

    // Return success with vehicle details
    echo json_encode([
        'success' => true,
        'vehicle_number' => $ambulance['vehicle_number'],
        'model' => $ambulance['model']
    ]);
} catch(PDOException $e) {
    error_log("Error booking ambulance: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>