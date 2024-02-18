<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin -Dashboard</title>
	<style>
    table {
		margin-top: 100px
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
		margin-top: 100px
    }
    th {
        background-color: #f2f2f2;
    }
    .button {
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }
    .edit {
        background-color: #4CAF50;
        color: white;
    }
    .delete {
        background-color: #f44336;
        color: white;
    }
</style>
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
                    <li><a href="../insert_product.php">Insert Art</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </div>
        </div>
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
            <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
</body>
</html>