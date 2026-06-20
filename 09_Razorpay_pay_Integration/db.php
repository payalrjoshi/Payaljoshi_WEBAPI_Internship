<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "razorpay_db"; // Make sure to import setup.sql into this database or create it

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>