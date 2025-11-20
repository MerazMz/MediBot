-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS login_system;

-- Use the database
USE login_system;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login DATETIME DEFAULT NULL,
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    profile_image VARCHAR(255) DEFAULT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    reset_token_expires DATETIME DEFAULT NULL,
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create user_sessions table for better session management
CREATE TABLE IF NOT EXISTS user_sessions (
    session_id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create login_attempts table for security
CREATE TABLE IF NOT EXISTS login_attempts (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    success BOOLEAN DEFAULT FALSE,
    INDEX idx_email_ip (email, ip_address),
    INDEX idx_attempt_time (attempt_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create user_activity_log table for auditing
CREATE TABLE IF NOT EXISTS user_activity_log (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity_type ENUM('login', 'logout', 'password_change', 'profile_update', 'failed_login') NOT NULL,
    activity_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45) DEFAULT NULL,
    details TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id_type (user_id, activity_type),
    INDEX idx_activity_time (activity_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add some helpful indexes
ALTER TABLE users
    ADD INDEX idx_created_at (created_at),
    ADD INDEX idx_updated_at (updated_at);

-- Create triggers for logging
DELIMITER //

CREATE TRIGGER after_user_update
AFTER UPDATE ON users
FOR EACH ROW
BEGIN
    IF OLD.password != NEW.password THEN
        INSERT INTO user_activity_log (user_id, activity_type, details)
        VALUES (NEW.id, 'password_change', 'Password was changed');
    END IF;
END//

CREATE TRIGGER after_user_login
AFTER UPDATE ON users
FOR EACH ROW
BEGIN
    IF NEW.last_login != OLD.last_login THEN
        INSERT INTO user_activity_log (user_id, activity_type, details)
        VALUES (NEW.id, 'login', CONCAT('Login at ', NEW.last_login));
    END IF;
END//

DELIMITER ;

-- Add some helpful comments
/*
This database structure includes:
1. Users table with essential user information
2. Session management table for tracking user sessions
3. Login attempts table for security monitoring
4. Activity log table for audit trails
5. Appropriate indexes for better query performance
6. Triggers for automatic logging of important events

Security features:
- Password hashing is handled in PHP code
- Email uniqueness is enforced
- Session tracking for security
- Login attempt monitoring
- Activity logging for audit trails

Additional features that can be implemented:
- Role-based access control by adding a roles table
- User preferences/settings table
- Password reset functionality using reset_token
- Profile image management
*/