<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Offers</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
              <!-----offer1-----> 
    <div class="header1">
    <div style="text-align: left; padding-left: 1080px;">
    <a href="cart.php" class="btn"><i class="fas fa-shopping-cart"></i> View Cart</a>
</div>
<div class="offer">
        <div class="m-container">
            
            <div class="image-container">
                <img src="WhatsApp Image 2025-03-14 at 12.02.23_777ff2e3.jpg" alt="black airpods">
            </div>
           
            <div class="text-container">
                <p><strong>Exclusively available on Audio Ally</strong></p>
                <h2>Classic AirPods</h2>
                <p>Get the classic AirPods today at an offer of <strong>15% off.</strong> 
                The pods come in three shades: green, black, and white, with a built-in power bank 
                system to give you power while on the go.</p>
                <button class="btn" onclick="addToCart('Classic AirPods', 5000)">
                <i class="fas fa-shopping-cart"></i> Add to cart
           </button>
            </div>          
        </div>
    </div>
    </div>

             <!-------offer2-----> 
    <div class="header1">
<div class="offer">
        <div class="m-container">
            
            <div class="image-container">
                <img src="WhatsApp Image 2025-03-14 at 12.02.38_d75a9484.jpg" alt="wireless earhones">
            </div>
           
            <div class="text-container">
                <p><strong>Exclusively available on Audio Ally</strong></p>
                <h2>Wireless earpones</h2>
                <p>Get the wirelesss earphones today at an offer of <strong>25% off.</strong> 
                The pods come in five shades: green, maroon, white, black, and white.</p>
                <button class="btn" onclick="addToCart('Wireless Earphones', 4000)">
    <i class="fas fa-shopping-cart"></i> Add to cart
       </button>
          </div>  
            
        </div>
    </div>
    </div>
    <script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(productName, price) {
        cart.push({ name: productName, price: price });
        localStorage.setItem('cart', JSON.stringify(cart));
        alert(productName + " added to cart!"); 
    }
</script>

</body>
</html>





