<?php
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
<div style="text-align: left; padding-left: 1080px;">
    <a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> View Cart</a>
</div>
<div class="s-container">
    <h1 style="text-align: center;"><?php echo htmlspecialchars($product_name); ?></h1> 
    
    <div class="row">
        <img src="<?php echo htmlspecialchars($product_image); ?>" alt="<?php echo htmlspecialchars($product_name); ?>">

        <div class="product-info">
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product_desc); ?></p>
            <p><strong>Price:</strong> Ksh <?php echo htmlspecialchars($product_price); ?></p>
            
            
            <button class="btn" onclick="addToCart('<?php echo htmlspecialchars($product_name); ?>', <?php echo htmlspecialchars($product_price); ?>)">
                <i class="fas fa-shopping-cart"></i> Add to cart
            </button>
        </div>
    </div>
</div>
<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(productName, price) {
        price = parseFloat(price); 
        cart.push({ name: productName, price: price });
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
        alert(productName + " added to cart!");
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }

    function updateCartDisplay() {
        const cartItems = document.getElementById('cartItems');
        const subtotalElement = document.getElementById('subtotal');
        
        if (!cartItems || !subtotalElement) return; 

        cartItems.innerHTML = '';
        let subtotal = 0;

        cart.forEach((item, index) => {
            cartItems.innerHTML += `<li>${item.name} - Ksh ${item.price} 
                <button onclick="removeFromCart(${index})">✖</button></li>`;
            subtotal += item.price;
        });

        subtotalElement.textContent = subtotal.toFixed(2);
    }

    function checkout() {
        if (cart.length === 0) {
            alert("Your cart is empty!");
        } else {
            alert("Proceeding to checkout. Total: Ksh " + document.getElementById("subtotal").textContent);
            localStorage.removeItem("cart");
            cart = [];
            updateCartDisplay();
        }
    }

    window.onload = updateCartDisplay;
</script>

</body>
</html>
