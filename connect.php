<?php
// Database configuration
$servername = "localhost";   // XAMPP বা Localhost server
$username   = "root";        // আপনার DB username
$password   = "";            // আপনার DB password (XAMPP default: "")
$dbname     = "ecobin_db";   // আপনার database নাম

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8
$conn->set_charset("utf8");

// Uncomment for debugging
// echo "Database connected successfully!";
?>
