<?php
session_start();
include 'connect.php';

// ✅ যদি লগইন না করে থাকে, তাহলে login page এ পাঠিয়ে দেবে
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leaderboard — EcoBin 🌿</title>
<style>
/* ===== Global Styles ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #b2dfdb, #e0f2f1);
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

/* ===== Header ===== */
header {
    width: 100%;
    background-color: #00796b;
    color: white;
    text-align: center;
    padding: 25px 0;
    font-size: 26px;
    font-weight: bold;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

/* ===== Container ===== */
.leaderboard-container {
    background: #ffffff;
    width: 90%;
    max-width: 800px;
    margin: 60px auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

/* ===== Heading ===== */
h2 {
    color: #004d40;
    margin-bottom: 20px;
}

/* ===== Table ===== */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 17px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #00796b;
    color: white;
}

tr:nth-child(even) {
    background-color: #e0f2f1;
}

/* ===== Rank Colors ===== */
.rank-1 { background: gold !important; font-weight: bold; }
.rank-2 { background: silver !important; font-weight: bold; }
.rank-3 { background: #cd7f32 !important; font-weight: bold; }

/* ===== Navigation Buttons ===== */
.nav-buttons {
    margin-top: 30px;
}

.nav-buttons a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #004d40;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    margin: 0 10px;
    transition: background 0.3s;
}

.nav-buttons a:hover {
    background-color: #00251a;
}
</style>
</head>
<body>

<header>
    EcoBin 🌿 Leaderboard
</header>

<div class="leaderboard-container">
    <h2>Top Eco Warriors 🌎</h2>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Email</th>
                <th>Eco Points</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // ✅ Fetch top users by eco points
            $sql = "SELECT name, email, eco_points FROM users ORDER BY eco_points DESC";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $rank = 1;
                while($row = $result->fetch_assoc()){
                    $rankClass = "";
                    if ($rank == 1) $rankClass = "rank-1";
                    elseif ($rank == 2) $rankClass = "rank-2";
                    elseif ($rank == 3) $rankClass = "rank-3";

                    echo "<tr class='$rankClass'>
                            <td>{$rank}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['eco_points']}</td>
                          </tr>";
                    $rank++;
                }
            } else {
                echo "<tr><td colspan='4'>No users found yet!</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="nav-buttons">
        <a href="dashboard.php">Back to Dashboard</a>
        <a href="leaderboard.php">Go to Leaderboard</a>
         <a href="about.php">About</a> 
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
