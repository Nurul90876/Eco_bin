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
<title>My Upload History — EcoBin 🌿</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
    display: flex; justify-content: center; align-items: flex-start;
    min-height: 100vh;
}
.content-wrapper {
    background: #fff; padding: 40px 30px; margin: 60px auto;
    border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    max-width: 1000px; width: 95%;
}
h2 { color: #2e7d32; text-align: center; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; font-size: 16px; min-width: 700px; }
th, td { border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle; }
th { background-color: #43a047; color: white; }
tr:nth-child(even){ background-color: #f0fdf0; }
img { width: 60px; border-radius: 6px; }

/* Navigation buttons */
.nav-buttons { margin-top: 20px; text-align: center; }
.nav-buttons a {
    display: inline-block; padding: 10px 20px; margin: 5px 10px;
    background-color: #2e7d32; color: #fff; text-decoration: none;
    border-radius: 6px; transition: 0.3s;
}
.nav-buttons a:hover { background-color: #1b5e20; }

/* Responsive */
@media (max-width: 768px){
    table, thead, tbody, th, td, tr { display: block; }
    tr { margin-bottom: 15px; border: 1px solid #ccc; border-radius: 10px; padding: 10px; }
    td { text-align: right; padding-left: 50%; position: relative; }
    td::before { content: attr(data-label); position: absolute; left: 10px; width: 45%; font-weight: bold; text-align: left; }
    img { width: 50px; }
}
</style>
</head>
<body>

<div class="content-wrapper">
    <h2>My Upload History 🌿</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Waste Type</th>
                <th>Disposal Instruction</th>
                <th>Date</th>
                <th>Eco Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT wp.prediction_id, wp.image_path, wp.predicted_label, wp.disposal_instruction, wp.created_at, u.eco_points
                    FROM waste_predictions wp
                    JOIN users u ON wp.user_id = u.user_id
                    WHERE wp.user_id=?
                    ORDER BY wp.created_at DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td data-label='ID'>{$row['prediction_id']}</td>
                            <td data-label='Image'><img src='{$row['image_path']}'></td>
                            <td data-label='Waste Type'>{$row['predicted_label']}</td>
                            <td data-label='Disposal Instruction'>{$row['disposal_instruction']}</td>
                            <td data-label='Date'>{$row['created_at']}</td>
                            <td data-label='Eco Points'>{$row['eco_points']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No uploads yet.</td></tr>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>

    <div class="nav-buttons">
        <a href="dashboard.php">Back to Dashboard</a>
        <a href="profile.php">My Profile</a>
        
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
