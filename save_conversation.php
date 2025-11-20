<?php
// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Add at the start of the file
error_log('Received share request: ' . file_get_contents('php://input'));

// Get JSON data from request
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id']) || !isset($data['messages'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit;
}

try {
    require_once 'db_connect.php'; // Use existing database connection
    
    // Check if table exists, create if it doesn't
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS chat_conversations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            conversation_id VARCHAR(255) NOT NULL UNIQUE,
            messages TEXT NOT NULL,
            created_at DATETIME NOT NULL,
            INDEX (conversation_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    
    // Add before the database insert
    error_log('Attempting to save conversation: ' . $data['id']);
    
    // Save conversation
    $stmt = $pdo->prepare("
        INSERT INTO chat_conversations (conversation_id, messages, created_at) 
        VALUES (?, ?, NOW())
    ");
    
    $stmt->execute([
        $data['id'],
        json_encode($data['messages'], JSON_UNESCAPED_UNICODE)
    ]);
    
    if ($stmt->rowCount() > 0) {
        // Add after successful save
        error_log('Successfully saved conversation: ' . $data['id']);
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Failed to save conversation');
    }
} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    error_log('General Error: ' . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
} 