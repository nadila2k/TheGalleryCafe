<?php
$servername = "localhost";
$username = "root";
$dataBase ="TheGalleryCafe";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,$dataBase);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>