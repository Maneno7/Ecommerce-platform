<?php
// Include the database connection
include '../config/db_connect.php';

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch product details from the database
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID specified.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <div class="product-container">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <img src="../assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>

        <!-- Add to Cart Form -->
        <form action="../cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>

        <a href="../index.php">Back to Shop</a>
    </div>

</body>
</html>
  
  