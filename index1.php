<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our E-Commerce Store</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Welcome to Our E-Commerce Store</h1>
        <nav>
            <ul>
                <li><a href="pages/add_product.php">Add Product</a></li>
                <li><a href="pages/cart.php">View Cart</a></li>
                <li><a href="pages/checkout.php">Checkout</a></li>
                <li><a href="pages/orders.php">My Orders</a></li>
                <li><a href="pages/all_orders.php">All Orders (Admin)</a></li>
                <li><a href="pages/dashboard.php">Dashboard</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <?php endif; ?>                
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Discover Amazing Products</h2>
            <p>Browse our selection of high-quality audio accessories and headphones.</p>
            <a href="pages/add_to_cart.php" class="btn">Start Shopping</a>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 E-Commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
