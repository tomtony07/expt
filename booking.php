<?php
// Include your database connection file or establish a connection here
// Example using mysqli
session_start(); // Start the session

// Check if the user is logged in and the email is set in the session
if (isset($_SESSION['logged_in_user'])) {
    $logged_in_user_email = $_SESSION['logged_in_user'];
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "travel_agency";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $package = $_POST["package"];
    $traveldate = $_POST["date"];
    $email = $logged_in_user_email;
    $bookingdate = date("Y-m-d");
    

    // SQL query to insert data into the 'packages' table
    $sql = "INSERT INTO booking (email,PackageID,BookingDate,TravelDate)
            VALUES ('$logged_in_user_email', '$package', '$bookingdate', '$traveldate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Packge inserted succesfully.');</script>";
        echo "<script>window.location.href='packages.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>