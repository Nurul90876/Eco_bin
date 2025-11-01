<?php
session_start();
include 'connect.php';

// যদি ইউজার লগইন না থাকে, তাহলে login.php তে রিডাইরেক্ট করবো
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

// ফর্ম সাবমিট করলে
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // প্রথমে বর্তমান পাসওয়ার্ড verify করবো
    $stmt = $conn->prepare("SELECT password FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($current, $db_password)) {
        $message = "<p style='color:red;'>❌ Current password incorrect.</p>";
    } elseif ($new !== $confirm) {
        $message = "<p style='color:red;'>❌ New passwords do not match.</p>";
    } else {
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password=? WHERE user_id=?");
        $update->bind_param("si", $hashed, $user_id);
        if ($update->execute()) {
            $message = "<p style='color:green;'>✅ Password updated successfully!</p>";
        } else {
            $message = "<p style='color:red;'>⚠️ Something went wrong. Try again!</p>";
        }
        $update->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Settings — EcoBin 🌿</title>
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}
.settings-container {
  background: #fff;
  padding: 40px 30px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  width: 400px;
  max-width: 90%;
  text-align: center;
}
h2 {
  color: #2e7d32;
  margin-bottom: 20px;
}
form {
  text-align: left;
}
label {
  font-weight: 600;
  display: block;
  margin-bottom: 5px;
}
input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 6px;
  border: 1px solid #bbb;
}
button {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 6px;
  background-color: #43a047;
  color: #fff;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
}
button:hover {
  background-color: #2e7d32;
}
a {
  display: inline-block;
  margin-top: 15px;
  color: #2e7d32;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<div class="settings-container">
  <h2>Account Settings ⚙️</h2>
  <p>Change your password below</p>

  <?php echo $message; ?>

  <form action="settings.php" method="post">
    <label>Current Password</label>
    <input type="password" name="current_password" required>

    <label>New Password</label>
    <input type="password" name="new_password" required>

    <label>Confirm New Password</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Update Password</button>
  </form>

  <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
