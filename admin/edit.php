<?php
include "connect.php";
session_start(); 

// Ensure the `item_id` is obtained from the POST request safely
$id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;

if ($id > 0 && isset($_POST['item_name']) && isset($_POST['distributor']) && isset($_POST['date_arrived']) && isset($_POST['date_left']) && isset($_POST['status'])) {
  $item_name = $_POST['item_name'];
  $distributor = $_POST['distributor'];
  $date_arrived = $_POST['date_arrived'];
  $date_left = $_POST['date_left'];
  $status = $_POST['status'];

  // Prepare the SQL statement to avoid SQL injection
  $stmt = $conn->prepare("UPDATE `items` 
                          SET `item_name` = ?, 
                              `distributor` = ?, 
                              `date_arrived` = ?, 
                              `date_left` = ?, 
                              `status` = ? 
                          WHERE `item_id` = ?");
  $stmt->bind_param("sssssi", $item_name, $distributor, $date_arrived, $date_left, $status, $id);

  // Execute the statement
  if ($stmt->execute()) {
    $_SESSION['message'] = "Record updated successfully";
    header("Location: crud.php"); // Redirect to the appropriate page
    exit();
  } else {
    $_SESSION['message'] = "Failed: " . $stmt->error;
    header("Location: crud.php"); // Redirect to the appropriate page
    exit();
  }

  $stmt->close();
} else {
  $_SESSION['message'] = "Invalid input.";
  header("Location: crud.php"); // Redirect to the appropriate page
  exit();
}

$conn->close();
?>
