<?php
// Product Listing (products.php)
include '../includes/db_connect.php';
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Our Products</h1>
    <div class="product-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="product">
                <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                <a href="product-details.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                <button onclick="addToCart(<?php echo $row['id']; ?>)" class="btn">Add to Cart</button>
            </div>
        <?php } ?>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
