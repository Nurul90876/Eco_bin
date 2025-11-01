<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EcoBin 🌿 — Smart Waste Management</title>
<style>
/* ===== Global Styles ===== */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #a8e063, #56ab2f);
  color: #fff;
  min-height: 100vh;
  display: flex;
  flex-direction: column; /* footer niche thakbe */
}

/* ===== Navbar ===== */
.navbar {
  background: rgba(0,0,0,0.2);
  display: flex;
  justify-content: center;
  gap: 25px;
  padding: 18px 0;
  font-weight: 500;
  position: sticky;
  top: 0;
  z-index: 100;
}
.navbar a {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
  transition: 0.3s;
  padding: 6px 12px;
  border-radius: 6px;
}
.navbar a:hover {
  color: #c2dcc0ff;
  background: rgba(255,255,255,0.1);
}

/* ===== Hero Section ===== */
.hero {
  text-align: center;
  padding: 150px 20px;
  flex: 1; /* footer niche thakbe */
}
.hero h1 {
  font-size: 48px;
  margin-bottom: 20px;
  font-weight: 700;
}
.hero p {
  font-size: 20px;
  max-width: 600px;
  margin: 0 auto 30px;
}
.hero .buttons a {
  display: inline-block;
  background: #2e7d32;
  color: #fff;
  text-decoration: none;
  padding: 12px 30px;
  border-radius: 8px;
  margin: 8px;
  font-size: 16px;
  transition: 0.3s;
}
.hero .buttons a:hover {
  background: #1b5e20;
}

/* ===== Footer ===== */
footer {
  text-align: center;
  padding: 20px;
  background: rgba(0,0,0,0.4);
  font-size: 14px;
  color: #fff;
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

<!-- 🌍 Hero Section -->
<div class="hero">
  <h1>Welcome to EcoBin 🌿</h1>
  <p>Join the movement towards a cleaner, greener world!  
  Upload waste images, earn eco points, and inspire others to recycle responsibly.</p>
  <div class="buttons">
    <a href="login.php">Login</a>
    <a href="register.php">Get Started</a>
  </div>
</div>

<!-- 🌱 Footer -->
<footer>
  © 2025 EcoBin — Smart Waste Management  |  Developed by Nurul Alam 💚
</footer>

</body>
</html>
