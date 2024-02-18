<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin -Dashboard</title>
</head>
<body>
 <div class="navigation">
            <div class="navbar">
                <div class="logo">
                    tm sketchArt.
                </div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="./dispplay_product.php">Display Art</a></li>
                    <li><a href="./insert_product.php">Insert Art</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </div>
        </div>

    <?php
  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'tmart');

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

    <form method="post" enctype="multipart/form-data">
		
		<div class="user-container">
		  <h1 id="title">Update Product</h1>
		  <div class="user-form">
        <input type="hidden" name="id" value="<?php echo $_GET['productID']; ?>">
        <div>
            <label for="name">New Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $old_name; ?>" required>
        </div><br>

        <div>
            <label for="desc">New Description:</label>
            <input type="text" id="desc" name="desc" value="<?php echo $old_desc; ?>" required>
        </div><br>

        <div>
            <label for="price">New Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $old_price; ?>" required>
        </div><br>

        <div>
            <label for="alias">Alias:</label>
            <select id="alias" name="alias" required>
                <option value="new" <?php echo ($old_alias == 'new' ? 'selected' : ''); ?>>New</option>
                <option value="featured" <?php echo ($old_alias == 'featured' ? 'selected' : ''); ?>>Featured</option>
            </select>
        </div>

        <div>
            <label for="img">New Image:</label>
            <input type="file" id="img" name="img" accept="image/*">
        </div><br>

        <input type="submit" value="Update">
		</div>
		</div>
    </form>

            <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
</body>
</html>