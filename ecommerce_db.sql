-- Step 1: Create the Database
CREATE DATABASE ecommerce_db;
USE ecommerce_db;

-- Step 2: Create Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Step 3: Create Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Step 4: Create Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Step 5: Create Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Step 6: Create an Admin User
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@example.com', MD5('admin123'), 'admin');

-- Step 7: Sample Products
INSERT INTO products (name, description, price, stock, image_url) VALUES 
('Laptop', 'High-performance laptop', 799.99, 10, 'laptop.jpg'),
('Smartphone', 'Latest model smartphone', 599.99, 20, 'smartphone.jpg'),
('Headphones', 'Noise-cancelling headphones', 199.99, 15, 'headphones.jpg');

-- Use the existing database
USE ecommerce_db;

-- Remove old sample products
DELETE FROM products;

-- Insert new audio accessories products
INSERT INTO products (name, description, price, stock, image_url) VALUES 
('Wireless Headphones', 'Noise-cancelling over-ear headphones with Bluetooth connectivity.', 129.99, 20, 'wireless_headphones.jpg'),
('Gaming Headset', 'High-quality gaming headset with surround sound and built-in mic.', 89.99, 15, 'gaming_headset.jpg'),
('Bluetooth Speaker', 'Portable Bluetooth speaker with deep bass and 12-hour battery life.', 79.99, 25, 'bluetooth_speaker.jpg'),
('Studio Microphone', 'Professional condenser microphone for recording and streaming.', 149.99, 10, 'studio_microphone.jpg'),
('True Wireless Earbuds', 'Compact and waterproof earbuds with noise isolation.', 59.99, 30, 'wireless_earbuds.jpg'),
('DJ Headphones', 'High-fidelity wired headphones for DJs and music producers.', 199.99, 12, 'dj_headphones.jpg');

-- Commit changes
COMMIT;




