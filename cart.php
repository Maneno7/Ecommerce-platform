<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="cart-container">
    <h1 style="text-align: center;">Your Cart</h1>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (Ksh)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cartItems">
            
        </tbody>
    </table>

    <h2>Total: Ksh <span id="subtotal">0</span></h2>

    <button class="btn" onclick="checkout()">
        <i class="fas fa-money-bill-wave"></i> Checkout
    </button>
</div>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(productName, price) {
        cart.push({ name: productName, price: price });
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }

    function updateCartDisplay() {
        const cartItems = document.getElementById('cartItems');
        const subtotalElement = document.getElementById('subtotal');
        cartItems.innerHTML = '';
        let subtotal = 0;

        cart.forEach((item, index) => {
            cartItems.innerHTML += `
                <tr>
                    <td>${item.name}</td>
                    <td>Ksh ${item.price}</td>
                    <td><button onclick="removeFromCart(${index})">✖Remove product</button></td>
                </tr>`;
            subtotal += item.price;
        });

        subtotalElement.textContent = subtotal;
    }

    function checkout() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
    } else {
        alert("Proceeding to checkout. Total: Ksh " + document.getElementById("subtotal").textContent);
        
        
        setTimeout(() => {
            alert("Thank you for purchasing our product at Audio Ally! Payment shall be collected upon pick-up at our office near you.");
        }, 500); 

    
        localStorage.removeItem("cart");
        cart = [];
        updateCartDisplay();
    }
}

    window.onload = function() {
        updateCartDisplay();
    };
</script>

</body>
</html>
