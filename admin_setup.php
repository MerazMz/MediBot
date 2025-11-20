<?php
require_once 'db_connect.php';

try {
    // First, let's clear any existing admin accounts
    $stmt = $pdo->prepare("TRUNCATE TABLE admins");
    $stmt->execute();
    
    // Create default admin account with predefined credentials
    $stmt = $pdo->prepare("
        INSERT INTO admins (username, password, email) 
        VALUES (?, ?, ?)
    ");
    
    // Predefined admin credentials - these should be changed in production
    $username = 'admin';
    $password = password_hash('Admin@123', PASSWORD_DEFAULT);
    $email = 'admin@example.com';
    
    $stmt->execute([$username, $password, $email]);
    
    echo "Default admin account created successfully!";

} catch(PDOException $e) {
    error_log("Error setting up admin account: " . $e->getMessage());
    echo "Error occurred while setting up admin account";
}
?>

<script>
    setTimeout(function() {
        window.location.href = 'admin_login.php';
    }, 3000);
</script> 