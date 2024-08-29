<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$db = "wazeflix";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Do not echo connection success messages in production
// echo "Connected successfully";
?>
