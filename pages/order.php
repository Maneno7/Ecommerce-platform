<?php
// Order Management (order.php)
session_start();
include '../includes/db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user orders
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="../canvas/css/style.css">
</head>
<body>
    <h1>Your Orders</h1>
    <div class="order-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="order">
                <p><strong>Order ID:</strong> <?php echo $row['id']; ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($row['total_price'], 2); ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                <p><strong>Ordered On:</strong> <?php echo $row['created_at']; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>