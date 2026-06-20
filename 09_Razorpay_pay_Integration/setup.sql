CREATE DATABASE IF NOT EXISTS razorpay_db;
USE razorpay_db;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contact VARCHAR(50) NOT NULL,
    amount INT NOT NULL,
    razorpay_order_id VARCHAR(255) NOT NULL,
    razorpay_payment_id VARCHAR(255) DEFAULT NULL,
    razorpay_signature VARCHAR(255) DEFAULT NULL,
    status ENUM('created', 'paid', 'failed') DEFAULT 'created',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
