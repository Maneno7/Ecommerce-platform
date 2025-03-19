<?php
// Admin - Add Product (admin/add_product.php)
session_start();
include '../includes/db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../canvas/index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
    $image_url = htmlspecialchars(trim($_POST['image_url']));

    // Validate price and stock
    if ($price <= 0) {
        echo "Error: Price must be a positive number.";
        exit;
    }
    if ($stock < 0) {
        echo "Error: Stock must be a non-negative number.";
        exit;
    }

    $sql = "INSERT INTO products (name, description, price, stock, image_url) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $name, $description, $price, $stock, $image_url);
    
    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <h2>Add a New Product</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="number" name="stock" placeholder="Stock Quantity" required>
        <input type="text" name="image_url" placeholder="Image Filename (e.g., product.jpg)" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>