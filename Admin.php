<?php
// Admin - Add Product (admin/add_product.php)
session_start();
include '../includes/db_connect.php';

// Ensure only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_url = $_POST['image_url'];

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
    <link rel="stylesheet" href="../css/style.css">
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


<?php
// Admin - Manage Orders (admin/manage_orders.php)
session_start();
include '../includes/db_connect.php';

// Ensure only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Orders</h1>
    <div class="order-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="order">
                <p><strong>Order ID:</strong> <?php echo $row['id']; ?></p>
                <p><strong>User ID:</strong> <?php echo $row['user_id']; ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($row['total_price'], 2); ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                <p><strong>Ordered On:</strong> <?php echo $row['created_at']; ?></p>
                <form method="POST" action="update_order.php">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>
