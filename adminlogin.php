<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = " ";
$dbname = "travel_agency"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password (for security, you should use a strong hashing algorithm)
$hashedPassword = hash('sha256', $password);

// Query to check if the provided email and hashed password exist in the database
$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    header("Location: adminpan.html");
    exit();
} else {
    // Login failed
    echo "Invalid email or password";
}

$conn->close();
?>