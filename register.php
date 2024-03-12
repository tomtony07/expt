<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Validate age
    if ($age < 1) {
        die("Invalid age");
    }
//johjklb
    // Validate password format
    $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,8}$/';
    if (!preg_match($passwordPattern, $password)) {
        die("Invalid password format");
    }

    // Validate confirm password
    if ($password !== $confirmPassword) {
        die("Passwords do not match");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $sql = "INSERT INTO users (username, email, age, password) VALUES ('$username', '$email', $age, '$hashedPassword')";
    $result = $conn->query($sql);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
