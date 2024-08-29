<?php
include "connect.php";
session_start(); 

if (isset($_POST['submit'])) {
  $item_name = $_POST['item_name'];
  $distributor = $_POST['distributor'];
  $date_arrived = $_POST['date_arrived'];
  $date_left = $_POST['date_left'];

  // Make sure `item_id` is not included here
  $sql = "INSERT INTO `items`(`item_name`, `distributor`, `date_arrived`, `date_left`) 
  VALUES ('$item_name','$distributor','$date_arrived','$date_left')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['message'] = "New record created successfully";
    header("Location: crud.php"); // Replace 'your_page.php' with the name of your current page
    exit();
  } else {
    $_SESSION['message'] = "Failed: " . mysqli_error($conn);
    header("Location: crud.php"); // Replace 'your_page.php' with the name of your current page
    exit();
  }
}
?>
