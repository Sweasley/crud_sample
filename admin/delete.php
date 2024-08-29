<?php 
include "connect.php";
session_start(); // Start the session to manage messages

// Get the item ID from the URL
$id = isset($_GET['item_id']) ? intval($_GET['item_id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM items WHERE item_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = "Record deleted successfully";
    } else {
        $_SESSION['message'] = "Failed: " . mysqli_error($conn);
    }
} else {
    $_SESSION['message'] = "Invalid item ID.";
}

header("Location: crud.php"); // Redirect to the main page
exit();
