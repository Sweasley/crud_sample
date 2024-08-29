<?php
include "connect.php";
session_start(); 

// Ensure the `item_id` is obtained from the POST request safely
$id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;

if ($id > 0 && isset($_POST['item_name']) && isset($_POST['distributor']) && isset($_POST['date_arrived']) && isset($_POST['date_left'])) {
  $item_name = $_POST['item_name'];
  $distributor = $_POST['distributor'];
  $date_arrived = $_POST['date_arrived'];
  $date_left = $_POST['date_left'];

  // Correct the SQL statement with proper syntax
  $sql = "UPDATE `items` 
          SET `item_name` = '$item_name', 
              `distributor` = '$distributor', 
              `date_arrived` = '$date_arrived', 
              `date_left` = '$date_left' 
          WHERE `item_id` = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: crud.php"); // Redirect to the appropriate page
    exit();
  } else {
    $_SESSION['message'] = "Failed: " . mysqli_error($conn);
    header("Location: crud.php"); // Redirect to the appropriate page
    exit();
  }
} else {
  $_SESSION['message'] = "Invalid input.";
  header("Location: crud.php"); // Redirect to the appropriate page
  exit();
}

mysqli_close($conn);
?>
