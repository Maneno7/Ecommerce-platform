<?php
// Cart System (cart.php)
session_start();
include '../includes/db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    if ($stmt->execute()) {
        echo "Added to cart";
    } else {
        echo "Error: " . $conn->error;
    }
    exit;
}

// Fetch cart items
$sql = "SELECT cart.id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="cart-item">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                <p>Quantity: <?php echo $row['quantity']; ?></p>
            </div>
        <?php } ?>
    </div>
    <a href="checkout.php" class="btn">Proceed to Checkout</a>
</body>
</html>