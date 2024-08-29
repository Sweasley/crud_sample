<?php
include 'connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT item_id, item_name, distributor, date_arrived, date_left FROM items WHERE item_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(array(
            'current_id' => $row['item_id'],
            'item_name' => $row['item_name'],
            'distributor' => $row['distributor'],
            'date_arrived' => $row['date_arrived'],
            'date_left' => $row['date_left']
        ));
    } else {
        echo json_encode(array('error' => 'Item not found.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid ID.'));
}

mysqli_close($conn);
?>
