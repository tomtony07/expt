<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
    <?php
// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
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

$sqll = "SELECT * FROM users WHERE email='$email'";
$resultt = $conn->query($sqll);


if ($result->num_rows > 0) {
  // Login successful
  session_start(); // Start the session
  $_SESSION['logged_in_user'] = $email; // Store the logged-in user's email in a session variable
  header("Location: pro.html");
  exit();
}
elseif (!isValidEmail($email)) {
  echo "<script>alert('Invalid email format.');</script>";
  echo "<script>window.location.href='login.html';</script>";
}

elseif($resultt->num_rows === 0) {
  echo "<script>alert('User doesnt Exist. Pleaser Sign Up');</script>";
  echo "<script>window.location.href='register.html';</script>";

}
else {
    // Login failed
    echo "<script>alert('Invalid Password');</script>";
    echo "<script>window.location.href='login.html';</script>";
}

$conn->close();
?>
