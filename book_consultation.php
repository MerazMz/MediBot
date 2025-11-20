<?php
session_start();
require_once 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = $_SESSION['user_id'];
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO consultations (doctor_id, user_id, date, time, status)
            VALUES (?, ?, ?, ?, 'scheduled')
        ");
        
        $stmt->execute([$doctor_id, $user_id, $date, $time]);
        $consultation_id = $pdo->lastInsertId();
        
        header("Location: video_consultation.php?consultation_id=" . $consultation_id);
        exit();
        
    } catch(PDOException $e) {
        $error = "Error scheduling consultation";
    }
}
?> 