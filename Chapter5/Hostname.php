<?php
$hostName = "localhost";
$username = "root";
$password = "";
$databasenam = "Rinn_db";

// Create connection
$cnn = mysqli_connect($hostName, $username, $password, $databasenam);

// Check the connection
if (!$cnn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

// Close the connection
mysqli_close($cnn);
?>
