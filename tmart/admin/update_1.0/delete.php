<?php
  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'artprints');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if product ID is provided
  if (isset($_GET['productID'])) {
    // Prepare the SQL statement
    $id = $_GET['productID'];
    $sql = "DELETE FROM product WHERE productID = ?";

    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        exit("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);

    // Execute the prepared statement
    if($stmt->execute()) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
  } else {
    echo "No product ID provided";
  }

  // Close the database connection
  $conn->close();
?>