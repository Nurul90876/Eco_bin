<?php
session_start();
include 'connect.php';

// Admin session check
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel — EcoBin 🌿</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0; padding: 0;
    background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
}

/* Navbar */
.navbar {
    background: linear-gradient(135deg, #43a047, #66bb6a);
    display: flex;
    justify-content: center;
    gap: 25px;
    padding: 18px 0;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}
.navbar a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: 0.3s;
}
.navbar a:hover {
    color: #e0f7e0;
    text-decoration: underline;
}

/* Content */
.content-wrapper {
    max-width: 1200px;
    margin: 40px auto;
    padding: 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Table */
.table-professional {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}
.table-professional th, .table-professional td {
    border: 1px solid #ccc;
    padding: 12px;
    text-align: center;
}
.table-professional th {
    background: linear-gradient(135deg, #43a047, #66bb6a);
    color: #fff;
    font-weight: 600;
}
.table-professional tr:nth-child(even){ background-color: #f0fdf0; }
.table-professional tr:hover { background-color: #d0f7c0; transition: 0.3s; }

/* Buttons */
.btn {
    padding: 6px 12px;
    background-color: #43a047;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: 0.3s;
}
.btn:hover { background-color: #2e7d32; }

/* Responsive */
@media (max-width:768px){
  .table-professional, thead, tbody, th, td, tr { display: block; }
  tr { margin-bottom: 15px; border: 1px solid #ccc; border-radius: 10px; padding: 10px; }
  td { text-align: right; padding-left: 50%; position: relative; }
  td::before { content: attr(data-label); position: absolute; left: 10px; width: 45%; font-weight: bold; text-align: left; }
}
</style>
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="admin.php">Admin Panel</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content-wrapper">
    <h2 style="text-align:center; color:#2e7d32;">Admin Panel — User Management</h2>
    <table class="table-professional">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Total Uploads</th>
                <th>Eco Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT u.user_id, u.name, u.email, u.role, u.eco_points, 
                       (SELECT COUNT(*) FROM waste_predictions wp WHERE wp.user_id = u.user_id) as total_uploads
                FROM users u
                ORDER BY u.user_id ASC";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td data-label='ID'>{$row['user_id']}</td>
                        <td data-label='Name'>{$row['name']}</td>
                        <td data-label='Email'>{$row['email']}</td>
                        <td data-label='Role'>{$row['role']}</td>
                        <td data-label='Total Uploads'>{$row['total_uploads']}</td>
                        <td data-label='Eco Points'>{$row['eco_points']}</td>
                        <td data-label='Actions'>
                            <a class='btn' href='edit_user.php?id={$row['user_id']}'>Edit</a>
                            <a class='btn' href='delete_user.php?id={$row['user_id']}' onclick=\"return confirm('Are you sure?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<footer style="background: linear-gradient(135deg, #43a047, #66bb6a); color:#fff; text-align:center; padding:20px; margin-top:40px;">
  © 2025 EcoBin — Smart Waste Management | Developed by Nurul Alam 💚
</footer>

</body>
</html>
