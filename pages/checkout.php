<?php
// Checkout System (checkout.php)
session_start();
include '../includes/db_connect.php';

$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT products.id, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

total_price = 0;
$order_items = [];

while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total_price += $subtotal;
    $order_items[] = [
        'product_id' => $row['id'],
        'quantity' => $row['quantity'],
        'price' => $row['price']
    ];
}

// Insert order
$order_sql = "INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'Pending')";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("id", $user_id, $total_price);
$order_stmt->execute();
$order_id = $order_stmt->insert_id;

// Insert order items
$order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$order_item_stmt = $conn->prepare($order_item_sql);
foreach ($order_items as $item) {
    $order_item_stmt->bind_param("iiii", $order_id, $item['product_id'], $item['quantity'], $item['price']);
    $order_item_stmt->execute();
}

// Clear cart after checkout
$conn->query("DELETE FROM cart WHERE user_id = $user_id");

header("Location: order_confirmation.php");
exit;
?>