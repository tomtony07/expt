<!DOCTYPE html>
<html>
<head>
  
 
</head>
<body>
<?php
include 'connection.php';

$uname = $_GET["username"];
$eid = $_GET["email"];
$age = $_GET["age"];
$pw1 = $_GET["password"];
$pw2 = $_GET["confirm_password"];

// Function to validate email format
function isValidEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password format
function isValidPassword($password) {
  // Password should have at least 8 characters, an uppercase letter, a special character, and a number
  return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
}

if (!isValidEmail($eid)) {
  echo "<script>alert('Invalid email format. Registration unsuccessful.');</script>";
  echo "<script>window.location.href='register.html';</script>";
}elseif ($pw1 !== $pw2) {
  echo "<script>alert('passwords do not match.');</script>";
  echo "<script>window.location.href='register.html';</script>";
} 
elseif (!isValidPassword($pw1)) {
  echo "<script>alert('Invalid password format. password must be minimum 8 charachters. it should have atleast 1 uppercase, One digit, one special character');</script>";
    echo "<script>window.location.href='login.html';</script>";
}
 elseif ($pw1 === $pw2 && isValidPassword($pw1)) {
  $query = "INSERT INTO users(username,email,age,password) VALUES ('$uname','$eid','$age','$pw1')";
  $result = $connect->query($query);

  if ($result) {
    echo "<script>alert('Registration successful. Welcome $uname');</script>";
    echo "<script>window.location.href='login.html';</script>";
  } else {
    echo "<script>alert('You already have an account with this email id.');</script>";
    echo "<script>window.location.href='register.html';</script>";
  }
} else {
  echo "<script>alert('Invalid password format. password must be minimum 8 charachters. it should have atleast 1 uppercase, One digit, one special character');</script>";
  echo "<script>window.location.href='login.html';</script>";
}
?>


</body>
</html>