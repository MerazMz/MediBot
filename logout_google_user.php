<?php
session_start();

// Clear Google Fit related session variables
unset($_SESSION['google_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);

header('Content-Type: application/json');
echo json_encode(['success' => true]);