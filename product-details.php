<?php
// Get product details from the URL (fallback to default values)
$product_name = $_GET['name'] ?? 'Default Product';
$product_image = $_GET['image'] ?? 'default.jpg';
$product_price = $_GET['price'] ?? '0';
$product_desc = $_GET['desc'] ?? 'No description available.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product_name); ?></title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
<div class="s-container">
    <h1 style="text-align: center;"><?php echo htmlspecialchars($product_name); ?></h1> 
    
    <div class="row">
        <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_name); ?>">

        <div class="product-info">
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product_desc); ?></p>
            <p><strong>Price:</strong> Ksh <?php echo htmlspecialchars($product_price); ?></p>
            <button class="btn">
            <i class="fas fa-shopping-cart"></i>Add to cart
         </button>

        </div>
    </div>
</div>
</body>
</html>
