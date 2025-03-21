<?php
session_start();

include "..\config\database_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "Password reset successful! <a href='login.php'>Login</a>";
    } else {
        echo "Error resetting password.";
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Page</title>
            <link rel="stylesheet" href="../assets/css/reset.css">
        </head>
        <body>
        <div class="reset-password-container">
          <h2>Reset Password</h2>

            <form id="reset-password-form">
              <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
              </div>
              <button type="submit" class="reset-button">Send Reset Link</button>
            </form>
            <p class="back-to-login">Back to <a href="login.html">Login</a></p>
        </div>
            <form method="post">
              <input type="email" name="email" placeholder="Enter your email" required>
              <input type="password" name="new_password" placeholder="Enter new password" required>
              <button type="submit">Reset Password</button>
            </form>
        </body>
     </html>

// Compare this snippet from ecommerce/auth/reset_password.php: