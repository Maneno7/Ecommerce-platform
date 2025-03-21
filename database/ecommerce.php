<?php
// Include database connection
require_once 'database_connect.php';

class Ecommerce {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all categories
    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch all products
    public function getProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch products by category
    public function getProductsByCategory($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a new product
    public function addProduct($name, $price, $category_id, $description, $image) {
        $sql = "INSERT INTO products (name, price, category_id, description, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdiss", $name, $price, $category_id, $description, $image);
        return $stmt->execute();
    }

    // Update product details
    public function updateProduct($id, $name, $price, $category_id, $description, $image) {
        $sql = "UPDATE products SET name = ?, price = ?, category_id = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdissi", $name, $price, $category_id, $description, $image, $id);
        return $stmt->execute();
    }

    // Delete a product
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Fetch all orders
    public function getOrders() {
        $sql = "SELECT * FROM orders";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update order status
    public function updateOrderStatus($order_id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    // Fetch cart items for a user
    public function getCartItems($user_id) {
        $sql = "SELECT * FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add item to cart
    public function addToCart($user_id, $product_id, $quantity) {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        return $stmt->execute();
    }

    // Update cart item
    public function updateCartItem($cart_id, $quantity) {
        $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $cart_id);
        return $stmt->execute();
    }

    // Delete cart item
    public function deleteCartItem($cart_id) {
        $sql = "DELETE FROM cart WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cart_id);
        return $stmt->execute();
    }

    // User registration
    public function registerUser($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        return $stmt->execute();
    }

    // User login
    public function loginUser($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    // Reset user password
    public function resetPassword($email, $new_password) {
      $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
      $sql = "UPDATE users SET password = ? WHERE email = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ss", $hashed_password, $email);
      return $stmt->execute();
    }
}

// Instantiate the Ecommerce class
$ecommerce = new Ecommerce($conn);
?>

