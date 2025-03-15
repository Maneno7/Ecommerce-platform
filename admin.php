<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecommerce_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    
    // Image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    
    $sql = "INSERT INTO products (name, price, image, description, stock) VALUES ('$name', '$price', '$image', '$description', '$stock')";
    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $_SESSION['message'] = "Product added successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE products SET name='$name', price='$price', image='$image', description='$description', stock='$stock' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price', description='$description', stock='$stock' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Product updated successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
}

// Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Product deleted successfully!";
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
}

// Fetch Products
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Admin Panel - Manage Products</h2>

    <?php if (isset($_SESSION['message'])) { ?>
        <p style="color:green;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php } ?>

    <h3>Add Product</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="file" name="image" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="stock" placeholder="Stock" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h3>Product List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $products->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><img src="uploads/<?php echo $row['image']; ?>" width="50"></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>" required>
                        <input type="file" name="image">
                        <textarea name="description" required><?php echo $row['description']; ?></textarea>
                        <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required>
                        <button type="submit" name="edit_product">Edit</button>
                    </form>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>" style="color:red;">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
