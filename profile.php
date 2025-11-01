<?php
session_start();
include 'connect.php';

// যদি লগইন করা না থাকে → login.php তে রিডাইরেক্ট
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// ইউজারের ডেটা ফেচ করা
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, eco_points FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// মোট আপলোড সংখ্যা ফেচ করা
$count_sql = "SELECT COUNT(*) AS total_uploads FROM waste_predictions WHERE user_id = ?";
$stmt2 = $conn->prepare($count_sql);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$count_result = $stmt2->get_result();
$count_data = $count_result->fetch_assoc();
$total_uploads = $count_data['total_uploads'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Profile — EcoBin 🌿</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 min-h-screen flex flex-col">

<!-- 🌿 Header -->
<header class="bg-green-600 text-white text-center py-5 shadow-md text-2xl font-semibold">
    EcoBin 🌿 — My Profile
</header>

<!-- 🌱 Profile Card -->
<div class="flex-1 flex justify-center items-center px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="User Avatar" class="w-24 h-24 mx-auto rounded-full mb-4 shadow-md">
        
        <h2 class="text-2xl font-bold text-green-700 mb-2"><?= htmlspecialchars($user['name']); ?></h2>
        <p class="text-gray-600 mb-4"><?= htmlspecialchars($user['email']); ?></p>

        <div class="grid grid-cols-2 gap-4 text-center my-4">
            <div class="bg-green-100 p-4 rounded-lg">
                <p class="text-sm text-gray-600">Eco Points</p>
                <p class="text-2xl font-bold text-green-700"><?= $user['eco_points']; ?></p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <p class="text-sm text-gray-600">Uploads</p>
                <p class="text-2xl font-bold text-green-700"><?= $total_uploads; ?></p>
            </div>
        </div>

        <div class="flex justify-center gap-4 mt-6">
            <a href="edit_profile.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">✏️ Edit Profile</a>
            
            <a href="dashboard.php" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">⬅ Back</a>
            <a href="About.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">About</a>
        </div>
    </div>
</div>

<!-- 🌍 Footer -->
<footer class="bg-green-700 text-white text-center py-3 mt-auto text-sm">
    © <?= date("Y"); ?>   EcoBin — All rights reserved |Developed by Nurul Alam 🌿
</footer>

</body>
</html>
