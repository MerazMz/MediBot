<?php
session_start();
require_once 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and validate form data
    $name = trim($_POST['name'] ?? '');
    $specialization = trim($_POST['specialization'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $rating = intval($_POST['rating'] ?? 0);
    $image_url = trim($_POST['image_url'] ?? '');

    // Validate specialization
    $valid_specializations = [
        'Cardiologist', 'Dermatologist', 'Pediatrician', 'Neurologist',
        'Orthopedic', 'Psychiatrist', 'Gynecologist', 'Dentist', 'General Physician'
    ];

    // Validate experience
    $valid_experiences = [
        '1-3 years', '3-5 years', '5-10 years', '10-15 years', '15+ years'
    ];

    // Basic validation
    if (empty($name) || empty($specialization) || empty($experience) || empty($image_url)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    if (!in_array($specialization, $valid_specializations)) {
        echo json_encode(['success' => false, 'message' => 'Invalid specialization']);
        exit;
    }

    if (!in_array($experience, $valid_experiences)) {
        echo json_encode(['success' => false, 'message' => 'Invalid experience']);
        exit;
    }

    if ($rating < 1 || $rating > 5) {
        echo json_encode(['success' => false, 'message' => 'Rating must be between 1 and 5']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO doctors (name, specialization, experience, rating, image_url, is_available) 
            VALUES (?, ?, ?, ?, ?, TRUE)
        ");
        
        $stmt->execute([$name, $specialization, $experience, $rating, $image_url]);
        
        echo json_encode(['success' => true, 'message' => 'Doctor added successfully']);
        exit;

    } catch(PDOException $e) {
        error_log("Error adding doctor: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Server error occurred']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?> 