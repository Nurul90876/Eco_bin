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
<title>Dashboard — EcoBin 🌿</title>
<style>
/* ==== Global Reset ==== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    font-family: 'Segoe UI', Arial, sans-serif;
    min-height: 100%;
    background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}

/* ==== Header ==== */
header {
    width: 100%;
    background-color: #43a047;
    color: white;
    text-align: center;
    padding: 25px 0;
    font-size: 26px;
    font-weight: bold;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

/* ==== Navigation Buttons ==== */
.nav-buttons {
    text-align: center;
    margin: 20px 0;
}

.nav-buttons a {
    display: inline-block;
    padding: 10px 20px;
    margin: 0 10px;
    background-color: #2e7d32;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}

.nav-buttons a:hover {
    background-color: #1b5e20;
}

/* ==== Content Wrapper ==== */
.content-wrapper {
    flex: 1;
    max-width: 1200px;
    margin: 20px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    overflow-x: auto;
}



/* ==== Headings ==== */
h2 {
    text-align: center;
    color: #2e7d32;
    margin-bottom: 25px;
    font-size: 28px;
}

/* ==== Table ==== */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    min-width: 700px;
}

th, td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: center;
    vertical-align: middle;
}

th {
    background-color: #43a047;
    color: white;
}

tr:nth-child(even){
    background-color: #f0fdf0;
}

img {
    width: 80px;
    border-radius: 6px;
}

/* ==== Responsive ==== */
@media (max-width: 768px){
    table, thead, tbody, th, td, tr {
        display: block;
    }
    tr { 
        margin-bottom: 15px; 
        border: 1px solid #ccc; 
        border-radius: 10px; 
        padding: 10px; 
    }
    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        width: 45%;
        font-weight: bold;
        text-align: left;
    }
    img { width: 60px; }
}
</style>
</head>
<body>

<header>
    EcoBin 🌿 Dashboard
</header>

<!-- Navigation Buttons -->
<div class="nav-buttons">
    <a href="upload.php">Upload Page</a>
    <a href="leaderboard.php">Leaderboard</a>
    <a href="profile.php" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">👤 My Profile</a>
<a href="history.php" style="padding:10px 20px; background:#1b5e20; color:#fff; border-radius:6px; text-decoration:none; margin:5px;">View My Upload History</a>
 <a href="about.php">About</a> 
 <a href="settings.php" style="padding:10px 20px; background:#66bb6a; color:#fff; border-radius:6px; text-decoration:none; margin:5px;">Settings</a>
 




</div>

<div class="content-wrapper">
    <h2>Recent Waste Uploads</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Image</th>
                <th>Waste Type</th>
                <th>Disposal Instruction</th>
                <th>Date</th>
                <th>Eco Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT wp.prediction_id, u.name, wp.image_path, wp.predicted_label, 
                           wp.disposal_instruction, wp.created_at, u.eco_points
                    FROM waste_predictions wp
                    JOIN users u ON wp.user_id = u.user_id
                    ORDER BY wp.created_at DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td data-label='ID'>{$row['prediction_id']}</td>
                            <td data-label='User'>{$row['name']}</td>
                            <td data-label='Image'><img src='{$row['image_path']}'></td>
                            <td data-label='Waste Type'>{$row['predicted_label']}</td>
                            <td data-label='Disposal Instruction'>{$row['disposal_instruction']}</td>
                            <td data-label='Date'>{$row['created_at']}</td>
                            <td data-label='Eco Points'>{$row['eco_points']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No uploads yet.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
