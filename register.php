<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if password and confirm_password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Error: Passwords do not match');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit(); // Stop further execution
    }

    // Check password format
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])[a-zA-Z0-9!@#$%^&*()-_+=]{8,30}$/", $password)) {
        echo "<script>alert('Error: Password must be between 8-30 characters long and contain at least 1 special character, 1 number, 1 uppercase letter, and 1 lowercase letter');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit(); // Stop further execution
    }

    // Database connection parameters
    $servername = "127.0.0.1"; // Change this if your MySQL server is on a different host
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $database = "travel_agency";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();

    if ($result_check_email->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Error: Email already exists');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit(); // Stop further execution
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into users table
$sql_insert_user = "INSERT INTO users (username, email, age, password, confirm_password) VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt_insert_user = $conn->prepare($sql_insert_user);
$stmt_insert_user->bind_param("ssiss", $username, $email, $age, $hashedPassword, $confirm_password);

// Execute the statement
if ($stmt_insert_user->execute()) {
    // Close statement
    $stmt_insert_user->close();
    
    // Close connection
    $conn->close();

    // Display registration successful message
    echo "<script>alert('Registration successful. Please login.');</script>";

    // Redirect to login page after displaying message
    echo "<script>window.location.href = 'login.html';</script>";
    exit(); // Stop further execution
} else {
    echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
}


    // Close statement and connection
    $stmt_insert_user->close();
    $conn->close();
}
?>
