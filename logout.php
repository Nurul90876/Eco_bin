<?php
session_start();

// ✅ সব সেশন ডেটা মুছে ফেলা
$_SESSION = array();

// ✅ সেশন সম্পূর্ণভাবে ধ্বংস করা
session_destroy();

// ✅ ইউজারকে লগইন পেজে রিডাইরেক্ট করা
header("Location: home.php");
exit;
?>
