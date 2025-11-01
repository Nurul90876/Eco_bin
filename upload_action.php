<?php
session_start();
include 'connect.php';

// ✅ Session check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// ✅ Allow only POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h3 style='color:red; text-align:center;'>Invalid Request Method 🚫</h3>";
    exit;
}

$user_id = $_SESSION['user_id'];
$waste_type = $_POST['waste_type'] ?? '';
$instruction = $_POST['disposal_instruction'] ?? '';
$image = $_FILES['image'] ?? null;

// ✅ Validation check
if (empty($waste_type) || empty($instruction) || !$image || $image['error'] !== 0) {
    echo "<h3 style='color:red; text-align:center;'>Please fill all fields and upload an image!</h3>";
    echo "<p style='text-align:center;'><a href='upload.php'>⬅ Go Back</a></p>";
    exit;
}

// ✅ Upload folder
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . time() . "_" . basename($image["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

// ✅ File type check
if (!in_array($imageFileType, $allowed_types)) {
    echo "<h3 style='color:red; text-align:center;'>Only JPG, JPEG, PNG, or GIF files allowed!</h3>";
    echo "<p style='text-align:center;'><a href='upload.php'>⬅ Go Back</a></p>";
    exit;
}

// ✅ Move uploaded file
if (!move_uploaded_file($image["tmp_name"], $target_file)) {
    echo "<h3 style='color:red; text-align:center;'>Error uploading the image!</h3>";
    echo "<p style='text-align:center;'><a href='upload.php'>⬅ Go Back</a></p>";
    exit;
}

// ✅ Eco points calculation (you can customize)
$eco_points = 0;
switch ($waste_type) {
    case 'Plastic': $eco_points = 10; break;
    case 'Metal': $eco_points = 15; break;
    case 'Organic': $eco_points = 8; break;
    case 'Paper': $eco_points = 5; break;
    default: $eco_points = 5;
}

// ✅ Insert into database
$stmt = $conn->prepare("INSERT INTO waste_predictions (user_id, image_path, predicted_label, disposal_instruction, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("isss", $user_id, $target_file, $waste_type, $instruction);
if ($stmt->execute()) {
    // ✅ Update user points
    $update = $conn->prepare("UPDATE users SET eco_points = eco_points + ? WHERE user_id = ?");
    $update->bind_param("ii", $eco_points, $user_id);
    $update->execute();

    // ✅ Redirect to dashboard
    header("Location: dashboard.php?success=1");
    exit;
} else {
    echo "<h3 style='color:red; text-align:center;'>Database error while saving!</h3>";
    echo "<p style='text-align:center;'><a href='upload.php'>⬅ Go Back</a></p>";
}
?>
