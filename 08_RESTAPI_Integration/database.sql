
CREATE DATABASE php_rest_demo;
USE php_rest_demo;

CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 fullname VARCHAR(100),
 email VARCHAR(150) UNIQUE,
 password VARCHAR(255),
 api_token VARCHAR(255),
 status ENUM('active','inactive') DEFAULT 'active',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
