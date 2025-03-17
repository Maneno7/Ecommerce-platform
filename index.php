<?php
// Homepage (index.php)
session_start();
include 'includes/db_connect.php';

// Fetch featured products
$sql = "SELECT * FROM products LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Headphones & Audio Accessories Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to the Headphones & Audio Accessories Store</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pages/products.php">Products</a></li>
                <li><a href="pages/cart.php">Cart</a></li>
                <li><a href="pages/login.php">Login</a></li>
                <li><a href="pages/register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Featured Products</h2>
        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="product">
                    <img src="images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                    <a href="pages/product-details.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                    <button onclick="addToCart(<?php echo $row['id']; ?>)" class="btn">Add to Cart</button>
                </div>
            <?php } ?>
        </div>
    </main>
    
    <script src="js/script.js"></script>
</body>
</html>
