<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALAXY MART</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Basic styling for the cart */
        .cart {
            position: fixed;
            top: 10px;
            right: 10px;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .cart h3 {
            margin: 0;
        }
        .cart ul {
            list-style: none;
            padding: 0;
        }
        .cart ul li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .cart ul li button {
            color: red;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1 class="sigei">Mall</h1>

<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="image/l.png" width="125px" alt="Shoe Mart Logo">
            </div>
            <nav>
                <ul id="menuitems">
                    <li><a href="">Home</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contacts</a></li>
                    <li><a href="">Account</a></li>
                </ul>
                <input type="text" id="searchInput" placeholder="Search products...">
                <button onclick="searchProducts()">Search</button>
            </nav>
            <div class="cart">
                <h3>Cart</h3>
                <ul id="cartItems"></ul>
                <p><strong>Subtotal: Ksh <span id="subtotal">0</span></strong></p>
                <button onclick="checkout()">Checkout</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-2">
                <h1>Give Your Workout<br> A New Style!</h1>
                <p>Success is not always about greatness. It's consistency.<br> Consistent hard work gains success. Greatness will come.</p>
                <a href="" class="btn">Explore now &#8594;</a>
            </div>
            <div class="col-2">
                <img src="image/sc.png" alt="Workout Shoes">
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="filters">
    <label for="priceFilter">Filter by Price:</label>
    <select id="priceFilter" onchange="filterProducts()">
        <option value="all">All</option>
        <option value="1500">Under Ksh 1,000</option>
        <option value="2000">Under Ksh 2,000</option>
        <option value="3000">Under Ksh 3,000</option>
    </select>
</div>

<!-- Featured Products -->
<div class="small-container">
    <h2 class="title">Featured Products</h2>
    <div class="row" id="productList">
        <div class="col-4">
            <img src="image/s1.png" alt="J4 White">
            <h4>Led flash headphones</h4>
            <p>Ksh 900</p>
            <button onclick="addToCart('Led flash headphones', 900)">Add to Cart</button>
        </div>
        
        <div class="col-4">
            <img src="image/s2.png" alt="J4 Blue">
            <h4>bluetooth light blue headphones</h4>
            <p>Ksh 1,500</p>
            <button onclick="addToCart('bluetooth wireless light blue headphones', 1500)">Add to Cart</button>
        </div>
        
        <div class="col-4">
            <img src="image/s3.png" alt="Airmax">
            <h4>jBL Tune 570Bt</h4>
            <p>Ksh 2,000</p>
            <button onclick="addToCart('jBL Tune 570Bt', 2800)">Add to Cart</button>
        </div>
        
        <div class="col-4">
            <img src="image/s5.png" alt="J4 Light Blue">
            <h4> BW.hèphones 410xl</h4>
            <p>Ksh 2,000</p>
            <button onclick="addToCart('BW.hèphones 410xl', 2000)">Add to Cart</button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <hr>
        <p>&copy; 2025 Galaxy Mart. All Rights Reserved.</p>
    </div>
</footer>

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
            cartItems.innerHTML += `<li>${item.name} - Ksh ${item.price} 
                <button onclick="removeFromCart(${index})">✖</button></li>`;
            subtotal += item.price;
        });

        subtotalElement.textContent = subtotal;
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

    function searchProducts() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const products = document.querySelectorAll('.col-4');
        let found = false;

        products.forEach(product => {
            product.style.display = product.querySelector('h4').textContent.toLowerCase().includes(query) ? 'block' : 'none';
            if (product.style.display === 'block') found = true;
        });

        if (!found) alert("No products found!");
    }

    function filterProducts() {
        const priceFilter = document.getElementById('priceFilter').value;
        const products = document.querySelectorAll('.col-4');
        let found = false;

        products.forEach(product => {
            product.style.display = (priceFilter === 'all' || parseInt(product.querySelector('p').textContent.replace('Ksh ', '')) <= parseInt(priceFilter)) ? 'block' : 'none';
            if (product.style.display === 'block') found = true;
        });

        if (!found) alert("No products found in this range.");
    }

    window.onload = updateCartDisplay;
</script>

</body>
</html>
