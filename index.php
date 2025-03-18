<?php
// Start session
session_start();

// Include database connection
include 'includes/db_connect.php';

// Include header
include 'includes/header.php';
?>

<!-- Main Content -->
<div class="container">
    <h1>Welcome to Our Headphones Store</h1>
    <p>Find the best headphones and audio accessories at the best prices.</p>

    <!-- Display Products -->
    <div class="product-list">
        <?php
        // Fetch products from database
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>$" . $row['price'] . "</p>";
                echo "<a href='product-details.php?id=" . $row['id'] . "' class='btn'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</div>

<?php
// Include footer
include 'includes/footer.php';
?>
