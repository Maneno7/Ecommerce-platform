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
('Charcoal Grey Headphones', 'Stylish charcoal grey headphones with premium sound.', 4500, 10, 'IMG-20250226-WA0005.jpg'),
('Blue Headphones', 'Experience premium sound with deep bass and noise cancellation.', 5000, 12, 'IMG-20250226-WA0006.jpg'),
('Grey Headphones', 'Comfortable wireless headphones with immersive audio.', 3800, 15, 'IMG-20250226-WA0007.jpg'),
('Green Headphones', 'Premium sound with cushioned ear pads for comfort.', 3800, 20, 'IMG-20250226-WA0008.jpg'),
('Blue Wireless Headphones', 'Wireless headphones with long battery life.', 3000, 18, 'IMG-20250226-WA0009.jpg'),
('Lavender Headphones', 'Soft color with deep bass and high-quality sound.', 4700, 16, 'IMG-20250226-WA0010.jpg'),
('Pink Headphones', 'Trendy pink headphones with powerful sound.', 4050, 14, 'IMG-20250226-WA0011.jpg'),
('Red Headphones', 'Immersive audio with deep bass and noise cancellation.', 5000, 11, 'IMG-20250226-WA0012.jpg'),
('White Headphones', 'Stylish white headphones with a premium build.', 4800, 9, 'IMG-20250226-WA0014.jpg'),
('Black Headphones', 'High-quality sound with long battery life.', 4900, 13, 'IMG-20250226-WA0015.jpg'),
('Lavender Headphones', 'Premium comfort with immersive sound quality.', 6000, 10, 'IMG-20250226-WA0017.jpg'),
('Maroon Headphones', 'Superior sound and comfort for long listening hours.', 4000, 15, 'IMG-20250226-WA0018.jpg'),
('Pink Headphones', 'Premium pink headphones with great audio performance.', 4550, 17, 'IMG-20250226-WA0019.jpg');

-- Commit changes
COMMIT;




