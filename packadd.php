<?php
// add_package.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $destination = $_POST["destination"];
    $images = $_POST["images"];
    $basePrice = $_POST["base-price"];
    $persons = $_POST["persons"];
    $totalPrice = $_POST["total-price"];

    // TODO: Add PHP code to insert the package details into the database
}
?>
