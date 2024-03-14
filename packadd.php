<?php
// Include your database connection file or establish a connection here
// Example using mysqli
$servername = "127.0.0.1";
$username = "root";
$password = " "; // Ensure your password is set correctly
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

    // Handle image upload
    if (isset($_FILES["image-url"]) && $_FILES["image-url"]["size"] > 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image-url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image-url"]["tmp_name"]);
        if ($check !== false) {
            // File is an image
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (max 5MB)
        if ($_FILES["image-url"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image-url"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars(basename($_FILES["image-url"]["name"])). " has been uploaded.";
                $imageUrl = $targetFile;

                // SQL query to insert data into the 'packages' table
                $sql = "INSERT INTO package (Name, Description, Price, Duration, DestinationName, departure_date, image_url)
                        VALUES ('$packageName', '$description', '$price', '$duration', '$destination', '$departureDate', '$imageUrl')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Package inserted successfully.');</script>";
                    echo "<script>window.location.href='packages.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file selected for upload.";
    }
}

// Close the database connection
$conn->close();
?>
