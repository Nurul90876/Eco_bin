<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EcoBin 🌿 — Contact Us</title>
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0; padding: 0;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
}

/* Header/Navbar */
.navbar {
  background: linear-gradient(135deg, #43a047, #66bb6a);
  display: flex;
  justify-content: center;
  gap: 25px;
  padding: 18px 0;
  box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}
.navbar a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  font-size: 16px;
  transition: 0.3s;
}
.navbar a:hover {
  color: #e0f7e0;
  text-decoration: underline;
}

/* Contact Form */
.contact-container {
  max-width: 500px;
  background: #fff;
  color: #333;
  margin: 60px auto;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.contact-container h2 {
  text-align: center;
  color: #2e7d32;
  margin-bottom: 25px;
}
.contact-container input, .contact-container textarea {
  width: 100%;
  padding: 12px;
  margin: 8px 0 18px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  transition: 0.3s;
}
.contact-container input:focus, .contact-container textarea:focus {
  border-color: #66bb6a;
  outline: none;
  box-shadow: 0 0 6px rgba(102,187,106,0.3);
}
.contact-container button {
  width: 100%;
  background: linear-gradient(135deg, #43a047, #66bb6a);
  color: #fff;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}
.contact-container button:hover {
  background: linear-gradient(135deg, #2e7d32, #43a047);
}

/* Alert Messages */
.alert {
  text-align: center;
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-weight: 500;
}
.alert.success {
  background: #c8f7c5;
  color: #256029;
  border: 1px solid #66bb6a;
}
.alert.error {
  background: #ffd7d7;
  color: #b71c1c;
  border: 1px solid #e57373;
}

/* Footer */
footer {
  background: linear-gradient(135deg, #43a047, #66bb6a);
  color: #fff;
  text-align: center;
  padding: 20px;
  margin-top: auto;
}
</style>
</head>
<body>

<!-- 🌿 Navbar -->
<div class="navbar">
  <a href="home.php">Home</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
</div>

<!-- ✉️ Contact Form -->
<div class="contact-container">
  <h2>📬 Contact Us</h2>

  <?php if (isset($_SESSION['contact_success'])): ?>
    <div class="alert success"><?= $_SESSION['contact_success']; unset($_SESSION['contact_success']); ?></div>
  <?php elseif (isset($_SESSION['contact_error'])): ?>
    <div class="alert error"><?= $_SESSION['contact_error']; unset($_SESSION['contact_error']); ?></div>
  <?php endif; ?>

  <form action="contact_action.php" method="POST">
    <label for="name">Full Name</label>
    <input type="text" name="name" placeholder="Enter your name" required>

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Enter your email" required>

    <label for="message">Message</label>
    <textarea name="message" rows="5" placeholder="Write your feedback or suggestion..." required></textarea>

    <button type="submit">Send Message</button>
  </form>
</div>

<!-- 🌱 Footer -->
<footer>
  © 2025 EcoBin — Smart Waste Management | Developed by Nurul Alam 💚
</footer>

</body>
</html>
