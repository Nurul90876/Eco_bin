<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
include 'connect.php';
 // যদি common header থাকে
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Waste — EcoBin 🌿</title>
<style>
/* ===== Global Styles ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #d0f0c0, #e0f7e0);
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}

/* ===== Content Wrapper ===== */
.content-wrapper {
    background: #ffffff;
    padding: 40px 30px;
    margin: 60px auto;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    max-width: 600px;
    width: 95%;
    text-align: center;
}

/* ===== Headings ===== */
h2 {
    color: #2e7d32;
    margin-bottom: 10px;
    font-size: 28px;
}

p {
    color: #555;
    margin-bottom: 25px;
}

/* ===== Form ===== */
form {
    text-align: left;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #333;
}

input[type="file"],
input[type="text"],
select {
    width: 100%;
    padding: 12px;
    margin-bottom: 18px;
    border-radius: 6px;
    border: 1px solid #bbb;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

input:focus, select:focus {
    border-color: #43a047;
    box-shadow: 0 0 6px rgba(67,160,71,0.4);
}

/* ===== Buttons ===== */
button {
    width: 100%;
    background-color: #43a047;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background-color: #2e7d32;
}

/* ===== Navigation Links ===== */
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

/* ===== Responsive ===== */
@media (max-width: 500px){
    .content-wrapper {
        padding: 25px 20px;
    }
}
</style>
</head>
<body>

<div class="content-wrapper">
    <h2>Upload Waste 🌿</h2>
    <p>Upload your waste image and details below:</p>

    <!-- Upload Form -->
    <form action="upload_action.php" method="post" enctype="multipart/form-data">
        <label>Image:</label>
        <input type="file" name="image" required>

        <label>Waste Type:</label>
        <select name="waste_type" required>
            <option value="">Select Waste Type</option>
            <option value="Plastic">Plastic</option>
            <option value="Metal">Metal</option>
            <option value="Organic">Organic</option>
            <option value="Paper">Paper</option>
        </select>

        <label>Disposal Instruction:</label>
        <input type="text" name="disposal_instruction" placeholder="E.g., Recycle, Compost, Dispose" required>

        <button type="submit">Upload</button>
    </form>

    <!-- Navigation Buttons -->
    <div class="nav-buttons">
      
<a href="about.php">About</a> 
   
    </div>

 

</div>

</body>
 
</html>
