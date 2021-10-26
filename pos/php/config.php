<?php
$servername = "localhost";
$username = "root";
$password = "@Dmin898";
$dbname = "inventorymanagement";

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
    // echo "Connected successfully";
?>