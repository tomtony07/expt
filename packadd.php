<?php
// Include your database connection file or establish a connection here
// Example using mysqli
$servername = "127.0.0.1";
$username = "root";
$password = " ";
$dbname = "travel_agency";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $packageName = $_POST["package-name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $duration = $_POST["duration"];
    $destination = $_POST["destination"];
    $departureDate = $_POST["departure-date"];
    $imageUrl = $_POST["image-url"];

    // SQL query to insert data into the 'packages' table
    $sql = "INSERT INTO package (Name, Description, Price, Duration, destinationName, departure_date, image_url)
            VALUES ('$packageName', '$description', '$price', '$duration', '$destination', '$departureDate', '$imageUrl')";

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
