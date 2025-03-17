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