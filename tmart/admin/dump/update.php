<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Product</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <main>
    <h1 id="title">Update Product</h1>

    <?php
  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'artprints');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if form data is available
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect post data
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $desc = $_POST['desc'];
  $alias = $_POST['alias'];

  // Prepare the SQL statement
  $sql = "UPDATE product SET name=?, price=?, description=?, alias=? WHERE productID=?";

  // Prepare the SQL statement
  $stmt = $conn->prepare($sql);

  if($stmt === false) {
    die("Error with the SQL Statement: ".$conn->error);
  } else {
    // Bind parameters to the prepared statement
    $stmt->bind_param("sdssi", $name, $price, $desc, $alias, $id);

    // Execute the prepared statement
    if($stmt->execute()) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: ".$stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
    // redirect to avoid resubmission on refresh
    header("location: update.php?productID=".$id);
    exit();
  }
  }

   // Check if product ID is provided
  if (isset($_GET['productID'])) {
    // Retrieve product information from the database based on the provided product ID
    $id = $_GET['productID'];
    $sql = "SELECT * FROM product WHERE productID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // Assign product information to variables
      $old_name = $row['name'];
      $old_desc = $row['description'];
      $old_price = $row['price'];
      $old_alias = $row['alias']; // fetch the alias from the database row
    } else {
      echo "No product found with ID: $id";
    }
  } else {
    echo "No product ID provided";
  }

  // Close the database connection
  $conn->close();
?>

<div role="form" aria-labelledby="title">
  <form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['productID']; ?>">
      <hr>
      <label for="name">New Name:</label><br>
      <input type="text" id="name" name="name" value="<?php echo $old_name; ?>" required><br>

      <label for="desc">New Description:</label><br>
      <input type="text" id="desc" name="desc" value="<?php echo $old_desc; ?>" required><br>

      <label for="price">New Price:</label><br>
      <input type="text" id="price" name="price" value="<?php echo $old_price; ?>" required><br>

      <label for="alias">Alias:</label><br>
      <select id="alias" name="alias" required>
          <option value="new" <?php echo ($old_alias == 'new' ? 'selected' : ''); ?>>New</option>
          <option value="featured" <?php echo ($old_alias == 'featured' ? 'selected' : ''); ?>>Featured</option>
      </select><br>

      <input type="submit" value="Update">
  </form>
</div>
</main>
</body>