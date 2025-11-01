<?php
ob_start();
session_start();
include 'connect.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // ✅ Session set
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                // ✅ Role-based redirect
                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                    exit;
                } else {
                    header("Location: dashboard.php");
                    exit;
                }
            } else {
                $message = "<p class='message error'>Incorrect password!</p>";
            }
        } else {
            $message = "<p class='message error'>Email not found!</p>";
        }
        $stmt->close();
    } else {
        $message = "<p class='message error'>Please enter email and password!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login — EcoBin 🌿</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #a8e6cf, #dcedc1, #81c784);
    display: flex; justify-content: center; align-items: center; min-height: 100vh;
}
.login-container {
    background: #fff; width: 400px; max-width: 90%;
    padding: 40px 30px; border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15); text-align: center;
}
h2 { color: #2e7d32; margin-bottom: 10px; }
p { color: #555; font-size: 15px; margin-bottom: 20px; }
form { text-align: left; margin-top: 15px; }
label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; }
input[type="email"], input[type="password"] {
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
</style>
</head>
<body>

<div class="login-container">
    <h2>Login 🌿</h2>
    <p>Enter your credentials to login</p>

    <?php echo $message; ?>

    <form action="login.php" method="post">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
