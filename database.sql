CREATE DATABASE IF NOT EXISTS php_core_expense CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE php_core_expense;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Mat khau mau: admin123
INSERT INTO users (name, email, password, role)
VALUES (
    'Administrator',
    'admin@example.com',
    '$2y$12$m1vObTWBnes4Y7ib8jvQFO5FXewmSPRJRAjFKXQqaiXP0zGNjePXS',
    'admin'
)
ON DUPLICATE KEY UPDATE email = email;
