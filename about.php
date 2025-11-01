<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About — EcoBin 🌿</title>
<style>
/* ===== Global Styles ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
    display: flex; justify-content: center; align-items: flex-start;
    min-height: 100vh;
}
.content-wrapper {
    background: #fff;
    padding: 40px 30px;
    margin: 60px auto;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    max-width: 900px;
    width: 95%;
    text-align: center;
}
h2 {
    color: #2e7d32;
    font-size: 28px;
    margin-bottom: 15px;
}
p {
    color: #555;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}
ul {
    text-align: left;
    margin: 20px auto;
    max-width: 700px;
    padding-left: 20px;
}
li {
    margin-bottom: 10px;
}
/* Navigation buttons */
.nav-buttons {
    margin-top: 30px;
    text-align: center;
}
.nav-buttons a {
    display: inline-block;
    padding: 10px 20px;
    margin: 5px 10px;
    background-color: #2e7d32;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}
.nav-buttons a:hover {
    background-color: #1b5e20;
}
/* Responsive */
@media (max-width: 500px){
    .content-wrapper { padding: 25px 20px; }
}
</style>
</head>
<body>

<div class="content-wrapper">
    <h2>About EcoBin 🌿</h2>
    <p>EcoBin is a smart platform designed to encourage waste recycling through gamified eco points. Our mission is to promote sustainable living and make recycling fun and rewarding for everyone.</p>

    <h3>Why EcoBin?</h3>
    <ul>
        <li>Encourage users to recycle and reduce waste.</li>
        <li>Track eco points and reward eco-friendly behavior.</li>
        <li>Provide insights on waste types and disposal methods.</li>
        <li>Foster a community of environmentally conscious users.</li>
    </ul>

    <h3>Developed By</h3>
    <p>Nurul Alam <br>
    Port City International University <br>
       Department : Computer Science & Enginnering <br> 
     Bangladesh</p>

    <!-- Navigation Buttons -->
    <div class="nav-buttons">
        <a href="dashboard.php">Dashboard</a>
        <a href="upload.php">Upload Waste</a>
        <a href="leaderboard.php">Leaderboard</a>
        <a href="profile.php">Profile</a>
        <a href="history.php">My Upload History</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
