<?php
include 'connect.php';

// Query to get the highest item ID from the items table
$sql = "SELECT MAX(item_id) AS max_id FROM items";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $next_id = $row['max_id'] + 1; // Increment the highest ID
    echo json_encode(array('next_id' => $next_id));
} else {
    echo json_encode(array('next_id' => '1')); // Default to 1 if there's an error
}

mysqli_close($conn);
?>
