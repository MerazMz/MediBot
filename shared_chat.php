<?php
// Add this at the top of the file for debugging
error_log('Requested URL: ' . $_SERVER['REQUEST_URI']);
error_log('Script path: ' . __FILE__);

session_start();
require_once 'db_connect.php';

// Get conversation ID from URL
$conversationId = $_GET['id'] ?? null;

if (!$conversationId) {
    header('Location: index.php');
    exit;
}

try {
    // Get conversation
    $stmt = $pdo->prepare("SELECT messages FROM chat_conversations WHERE conversation_id = ?");
    $stmt->execute([$conversationId]);
    $conversation = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$conversation) {
        throw new Exception('Conversation not found');
    }
    
    $messages = json_decode($conversation['messages'], true);
    if (!$messages) {
        throw new Exception('Invalid message format');
    }
} catch (Exception $e) {
    error_log('Error loading shared chat: ' . $e->getMessage());
    header('Location: index.php?error=invalid_share');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Conversation - Dispnsary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://demo.awaikenthemes.com/dispnsary/wp-content/uploads/2024/11/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-2xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h1 class="text-2xl font-bold text-[#4c63ce] mb-6">Shared Chat Conversation</h1>
            <div class="space-y-4">
                <?php foreach ($messages as $message): ?>
                    <?php if ($message['type'] === 'user'): ?>
                        <div class="flex justify-end">
                            <div class="bg-[#4c63ce] text-white rounded-lg p-3 max-w-[80%]">
                                <p><?php echo htmlspecialchars($message['content']); ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex justify-start">
                            <div class="bg-gray-100 rounded-lg p-3 max-w-[80%]">
                                <p><?php echo htmlspecialchars($message['content']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="mt-6 text-center">
                <a href="index.php" class="inline-flex items-center gap-2 bg-[#4c63ce] text-white px-4 py-2 rounded-full hover:bg-[#3b4fa3] transition-colors">
                    <i class="fas fa-robot"></i>
                    Start Your Own Chat
                </a>
            </div>
        </div>
    </div>
</body>
</html> 