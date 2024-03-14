<?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = " "; // Change this to your actual database password
$dbname = "travel_agency"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$hashedPassword = hash('sha256', $password);

// Function to validate email format
function isValidEmail($eid) {
    return filter_var($eid, FILTER_VALIDATE_EMAIL);
}

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

$sqll = "SELECT * FROM users WHERE email='$email' AND desig='admin'";
$resultt = $conn->query($sqll);

if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();
    if ($row['desig'] === 'admin') {
        session_start(); // Start the session
        $_SESSION['logged_in_user'] = $email; // Store the logged-in user's email in a session variable
        header("Location: adminpan.html");
    } else {
        session_start(); // Start the session
        $_SESSION['logged_in_user'] = $email; // Store the logged-in user's email in a session variable
        header("Location: pro.html");
    }
    exit();
} elseif (!isValidEmail($email)) {
    echo "<script>alert('Invalid email format.');</script>";
    echo "<script>window.location.href='login.html';</script>";
} else {
    // Login failed
    echo "<script>alert('Invalid Username or Password');</script>";
    echo "<script>window.location.href='login.html';</script>";
}

$conn->close();
?>
