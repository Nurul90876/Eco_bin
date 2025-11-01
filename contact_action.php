<?php
session_start();
include 'connect.php'; // এখানে তোমার database connection ফাইল থাকবে

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ফর্ম থেকে ইনপুট সংগ্রহ
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // ইনপুট যাচাই
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['contact_error'] = "⚠️ সব ফিল্ড পূরণ করুন।";
        header("Location: contact.php");
        exit;
    }

    // ইমেইল ফরম্যাট ঠিক আছে কিনা চেক
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_error'] = "⚠️ সঠিক ইমেইল দিন।";
        header("Location: contact.php");
        exit;
    }

    // ডাটাবেসে ইনসার্ট করা
    $sql = "INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $_SESSION['contact_success'] = "✅ আপনার মেসেজ সফলভাবে পাঠানো হয়েছে!";
    } else {
        $_SESSION['contact_error'] = "❌ মেসেজ পাঠাতে সমস্যা হয়েছে, আবার চেষ্টা করুন।";
    }

    $stmt->close();
    $conn->close();

    header("Location: contact.php");
    exit;
} else {
    header("Location: contact.php");
    exit;
}
?>
