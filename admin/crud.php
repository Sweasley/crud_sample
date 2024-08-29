<?php
include "connect.php";
session_start(); // Start the session

// Set the user ID (you mentioned user ID 1)
$userID = 1;

// Fetch the username from the database based on the user ID
$setDetails = "SELECT username FROM users WHERE id = $userID";
$getDetails = $conn->query($setDetails);

if ($getDetails->num_rows > 0) {
    $placeDetails = $getDetails->fetch_assoc();
    $username = $placeDetails['username'];
} else {
    $username = "Guest"; // Default value if the user is not found
}

// Check if there's a message set in the session
if (isset($_SESSION['message'])) {
  echo '<script>
          var message = "' . $_SESSION['message'] . '";
          window.onload = function() {
            var alertModal = new bootstrap.Modal(document.getElementById("alertModal"));
            document.getElementById("alertMessage").innerText = message;
            alertModal.show();
            setTimeout(function() {
              alertModal.hide();
            }, 3000); // Hide after 3 seconds
          };
        </script>';
  // Unset the message after displaying it
  unset($_SESSION['message']);
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- icon  -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="../css/styles.css" />


  </head>
  <body>
    <h1 class="text-center mt-3">Hello,<?php echo $username; ?></h1>
    <div class="container">
      <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn mb-3 btn-outline-secondary">Add new</button>
      <table class="table table-hover rounded-3 table-responsive">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">Distributor</th>
            <th scope="col">Date Arrived</th>
            <th scope="col">Date Departed</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php 
          include "connect.php";
          
            $sql = "SELECT * FROM ITEMS ";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
            ?>
          <tr>
            <td><?php echo $row['item_id']?></td></td>
            <td><?php echo $row['item_name']?></td></td>
            <td><?php echo $row['distributor']?></td></td>
            <td><?php echo $row['date_arrived']?></td></td>
            <td><?php echo $row['date_left']?></td></td>
            <td class="buttons text-center">
    <div class="d-flex justify-content-center">
    <button type="button" class="btn ps-md-1 p-sm-7 me-2 ms-1 align-items-center justify-content-center text-center del" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $row['item_id']; ?>">
    <span class="ms-md-1"><i class="bi bi-pencil-square fs-5 fs-lg-4 fs-md-3 fs-sm-1 m-1 "></i></span>
</button>

<button type="button" class="btn ps-md-1 p-sm-7 ms-1 align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $row['item_id']; ?>">
  <span class="ms-md-1"> <i class="bi bi-trash fs-5 fs-lg-4 fs-md-3 fs-sm-1 m-1"></i></span>
</button>

    </div>
</td>
          </tr>
          <?php
            }
            ?>
        </tbody>
        </tbody>
      </table>
    </div>



 

<!-- Add Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="addModalLabel">Add New Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="add.php" method="post">
          <div class="row mb-3">
            <div class="col-12">
            <div class="form-floating">
                <input type="text" class="form-control" id="itemID" placeholder="Item ID" name="item_id" readonly>
                <label for="itemID">Item ID</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="itemName" placeholder="Enter item name" name="item_name"> 
                <label for="itemName">Item Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="distributor" placeholder="Enter distributor name" name="distributor">
                <label for="distributor">Distributor</label>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="dateArrived" name="date_arrived">
                <label for="dateArrived">Date Arrived</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="dateLeft" name="date_left">
                <label for="dateLeft">Date Departed</label>
              </div>
            </div>
          </div>
          <!-- Submit Button inside the form -->
          <div class="modal-footer">
            <button type="button" class="btn del " data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn " id="save" name="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary" id="editModalLabel">Edit Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit.php" method="post">
          <!-- Hidden field for Item ID -->
          <input type="hidden" name="item_id" id="itemID_edit_hidden">
          
          <!-- Item ID (read-only) -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="itemID_edit" placeholder="Item ID" readonly>
                <label for="itemID_edit">Item ID</label>
              </div>
            </div>
          </div>

          <!-- Item Name and Distributor -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="item_name" class="form-control" id="itemName_edit" placeholder="Enter item name">
                <label for="itemName_edit">Item Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="distributor" class="form-control" id="distributor_edit" placeholder="Enter distributor name">
                <label for="distributor_edit">Distributor</label>
              </div>
            </div>
          </div>

          <!-- Date Arrived and Date Left -->
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="dateArrived_edit" name="date_arrived">
                <label for="dateArrived_edit">Date Arrived</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" id="dateLeft_edit" name="date_left">
                <label for="dateLeft_edit">Date Departed</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn del" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn" id="save">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
        <!-- Form to handle deletion -->
        <form id="deleteForm" action="delete.php" method="get">
          <input type="hidden" id="item_id_delete" name="item_id">
          <button type="button" class="btn del " data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn ">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


 <!-- Alert Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alertModalLabel">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="alertMessage"></p>
      </div>
    </div>
  </div>
</div>


  </body>
  <script src="../js/crud_script.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>

</html>
