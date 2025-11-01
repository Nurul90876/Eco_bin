<?php
session_start();
include 'connect.php';

// লগইন না করা থাকলে login.php তে পাঠাও
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// প্রথমে বর্তমান ইউজারের তথ্য ফেচ করি
$stmt = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$message = "";

// যদি ফর্ম সাবমিট হয়
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE user_id=?");
        $update->bind_param("sssi", $name, $email, $hashed, $user_id);
    } else {
        $update = $conn->prepare("UPDATE users SET name=?, email=? WHERE user_id=?");
        $update->bind_param("ssi", $name, $email, $user_id);
    }

    if ($update->execute()) {
        $message = "<p class='text-green-700 font-semibold mt-3'>✅ Profile updated successfully!</p>";
        $_SESSION['name'] = $name;
    } else {
        $message = "<p class='text-red-600 font-semibold mt-3'>⚠️ Something went wrong. Try again!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile — EcoBin 🌿</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 min-h-screen flex flex-col">

<!-- 🌿 Header -->
<header class="bg-green-600 text-white text-center py-5 shadow-md text-2xl font-semibold">
    Edit Profile — EcoBin 🌿
</header>

<!-- 🌱 Edit Form -->
<div class="flex-1 flex justify-center items-center px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-green-700 mb-4">Update Your Info</h2>

        <form method="POST" class="text-left">
            <label class="font-semibold text-gray-700">Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-green-400">

            <label class="font-semibold text-gray-700">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-green-400">

            <label class="font-semibold text-gray-700">New Password (optional):</label>
            <input type="password" name="password" placeholder="Enter new password if you want to change" class="w-full p-3 border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-green-400">

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                💾 Save Changes
            </button>
        </form>

        <?= $message; ?>

        <div class="mt-6 flex justify-center gap-4">
            <a href="profile.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">⬅ Back to Profile</a>
            <a href="dashboard.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">🏠 Dashboard</a>
        </div>
    </div>
</div>

<footer class="bg-green-700 text-white text-center py-3 mt-auto text-sm">
    © <?= date("Y"); ?> EcoBin — All rights reserved 🌿
</footer>

</body>
</html>
