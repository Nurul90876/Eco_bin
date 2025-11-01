<?php
ob_start(); // Output buffering to prevent "headers already sent" warning
session_start();
include 'connect.php';

$message = ""; // For error/success messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "<p class='message error'>Passwords do not match!</p>";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if($stmt->num_rows > 0){
            $message = "<p class='message error'>Email already registered!</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);
            if($stmt->execute()){
                // Registration successful, redirect to login page
                header("Location: login.php?registered=1");
                exit;
            } else {
                $message = "<p class='message error'>Something went wrong. Try again!</p>";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register — EcoBin 🌿</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #a8e6cf, #dcedc1, #81c784);
    display: flex; justify-content: center; align-items: center;
    min-height: 100vh;
}
.register-container {
    background: #fff; width: 400px; max-width: 90%;
    padding: 40px 30px; border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15); text-align: center;
}
h2 { color: #2e7d32; margin-bottom: 10px; }
p { color: #555; font-size: 15px; margin-bottom: 20px; }
form { text-align: left; margin-top: 15px; }
label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; }
input[type="text"], input[type="email"], input[type="password"] {
    width: 100%; padding: 12px; margin-bottom: 18px;
    border-radius: 6px; border: 1px solid #bbb; font-size: 15px; outline: none;
}
input:focus { border-color: #43a047; box-shadow: 0 0 6px rgba(67,160,71,0.4); }
button {
    width: 100%; background-color: #43a047; color: #fff;
    border: none; border-radius: 6px; padding: 12px;
    font-size: 16px; font-weight: 600; cursor: pointer;
}
button:hover { background-color: #2e7d32; }
a { color: #2e7d32; text-decoration: none; font-weight: 600; }
a:hover { text-decoration: underline; }
.message { text-align: center; margin-bottom: 15px; font-weight: 600; }
.message.error { color: red; }
.message.success { color: green; }
@media (max-width: 500px) {
    .register-container { padding: 25px 20px; }
}
</style>
</head>
<body>

<div class="register-container">
    <h2>Register 🌿</h2>
    <p>Create your account to start earning Eco Points!</p>

    <?php echo $message; ?>

    <form action="register.php" method="post">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>