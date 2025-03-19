<?php
// User Registration (register.php)
include '../includes/db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'customer')";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error: " . $conn->error;
    } else {
        $stmt->bind_param("sss", $name, $email, $password);
        
        if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../canvas/css/style.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>