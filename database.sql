-- 1️⃣ Create Database
CREATE DATABASE IF NOT EXISTS coffeeshop_db;
USE coffeeshop_db;

-- 2️⃣ Customers/admin Table
CREATE TABLE IF NOT EXISTS user_admin_tb(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
