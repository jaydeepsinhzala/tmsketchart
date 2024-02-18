<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Product</h2>

<form action="insert_product.php" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <!-- Dropdown menu for selecting alias -->
    <label for="alias">Alias:</label><br>
    <select id="alias" name="alias">
        <option value="new">New</option>
        <option value="featured">Featured</option>
    </select><br>
    <label for="desc">Description:</label><br>
    <input type="text" id="desc" name="desc"><br>
    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price"><br>
    <label for="img">Image:</label><br>
    <input type="file" id="img" name="img" accept="image/*"><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
<?php
// Check if form data is available
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'artprints');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   // Collect post data
$name = $_POST['name'];
$alias = $_POST['alias'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$img = basename($_FILES["img"]["name"]); // Assuming you're storing only the filename in the database

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO `product`(`name`, `alias`, `description`, `price`, `image`) 
                        VALUES (?, ?, ?, ?, ?)");

// Check if the SQL statement preparation was successful
if (!$stmt) {
    die("Error in SQL query: " . $conn->error);
}

// Bind parameters to the prepared statement
$stmt->bind_param("sssss", $name, $alias, $desc, $price, $img);


// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Move uploaded image to a directory on the server
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);


    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>