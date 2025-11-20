<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $doctor_id = trim($_POST['doctor_id'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $user_id = $_SESSION['user_id'] ?? null;

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($doctor_id)) {
        header("Location: booknow.php?error=empty");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: booknow.php?error=invalid_email");
        exit();
    }

    // Validate phone number (basic validation)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        header("Location: booknow.php?error=invalid_phone");
        exit();
    }

    // Validate date (must be future date)
    $appointment_date = new DateTime($date);
    $today = new DateTime();
    if ($appointment_date < $today) {
        header("Location: booknow.php?error=invalid_date");
        exit();
    }

    try {
        // First check if the doctor exists
        $checkDoctor = $pdo->prepare("SELECT id FROM doctors WHERE id = ?");
        $checkDoctor->execute([$doctor_id]);
        if (!$checkDoctor->fetch()) {
            header("Location: booknow.php?error=invalid_doctor");
            exit();
        }

        // Check if the time slot is available
        $checkSlot = $pdo->prepare("
            SELECT id FROM appointments 
            WHERE doctor_id = ? 
            AND appointment_date = ? 
            AND appointment_time = ? 
            AND status != 'cancelled'
        ");
        $checkSlot->execute([$doctor_id, $date, $time]);
        if ($checkSlot->fetch()) {
            header("Location: booknow.php?error=slot_taken");
            exit();
        }

        // Insert the appointment
        $stmt = $pdo->prepare("
            INSERT INTO appointments (
                user_id, fullname, email, phone, 
                appointment_date, appointment_time, 
                doctor_id, message, status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')
        ");

        $stmt->execute([
            $user_id,
            $name,
            $email,
            $phone,
            $date,
            $time,
            $doctor_id,
            $message
        ]);

        // Send email notification (you can implement this later)
        // sendEmailNotification($email, $name, $date, $time);

        header("Location: booknow.php?success=1");
        exit();

    } catch(PDOException $e) {
        error_log("Booking error: " . $e->getMessage());
        header("Location: booknow.php?error=server");
        exit();
    }
} else {
    // If not POST request, redirect to booking page
    header("Location: booknow.php");
    exit();
}

function sendEmailNotification($email, $name, $date, $time) {
    // Implement email notification functionality here
    // You can use PHPMailer or other email libraries
}
?> 