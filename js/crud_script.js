document.addEventListener("DOMContentLoaded", function () {
  // Get the modal elements
  var addModal = document.getElementById("addModal");
  var editModal = document.getElementById("editModal");
  var deleteModal = document.getElementById("deleteModal");

  // Event listener for the Add Modal
  addModal.addEventListener("shown.bs.modal", function () {
    // Fetch the next item ID when the Add Modal is shown
    fetch("get_next_id.php")
      .then((response) => response.json()) // Parse the JSON response
      .then((data) => {
        // Set the item ID field with the next ID from the server
        document.getElementById("itemID").value = data.next_id;
      })
      .catch((error) => console.error("Error fetching next item ID:", error)); // Log any errors
  });

  // Event listener for the Edit Modal
  editModal.addEventListener("shown.bs.modal", function (event) {
    // Get the button that triggered the modal
    var button = event.relatedTarget;
    // Extract the item ID from the button's data-* attribute
    var itemId = button.getAttribute("data-id");

    // Fetch the current details of the item based on the ID
    fetch(`get_current_id.php?id=${itemId}`)
      .then((response) => response.json()) // Parse the JSON response
      .then((data) => {
        // Populate the edit modal fields with the fetched data
        document.getElementById("itemID_edit").value = data.current_id; // Set the item ID (read-only)
        document.getElementById("itemID_edit_hidden").value = data.current_id; // Hidden field for form submission
        document.getElementById("itemName_edit").value = data.item_name; // Set the item name
        document.getElementById("distributor_edit").value = data.distributor; // Set the distributor name
        document.getElementById("dateArrived_edit").value = data.date_arrived; // Set the date arrived
        document.getElementById("dateLeft_edit").value = data.date_left; // Set the date left
      })
      .catch((error) =>
        console.error("Error fetching current item ID:", error)
      ); // Log any errors
  });
  deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var itemId = button.getAttribute("data-id"); // Extract item ID from data-* attribute

    // Set the item ID in the hidden input field of the delete form
    document.getElementById("item_id_delete").value = itemId;
  });
});
