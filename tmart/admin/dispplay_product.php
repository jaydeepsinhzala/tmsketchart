<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Admin -Dashboard</title>
	<style>
    table {
	
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
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
                    <li><a href="./insert_product.php">Insert Art</a></li>
                    <li><a href="cart.php">ORDERS</a></li>
					 <li><a href="logout.php">logout</a></li>
                </ul>
            </div>
        </div>
   <!-- Product Table -->
<div class="user-container" >
<table>
  <thead>
    <tr>
      <th>ProductID</th>
      <th>Name</th>
      <th>Price</th>
	  <th>Description</th>
      <th>Image</th>
	  <th>alias</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmart";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["productID"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["price"]."</td>
				<td>".$row["description"]."</td>
                <td><img src='../img/".$row["image"]."' alt='".$row["name"]."' width='50'></td>
				<td>".$row["alias"]."</td>
                <td>
                    <a href='delete.php?productID=".$row['productID']."' class='button delete'>Delete</a>
                    <a href='update_product.php?productID=".$row['productID']."' class='button edit'>Update</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>0 results</td></tr>";
}
$conn->close();
?>
  </tbody>
</table>
</div>
            <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
</body>
</html>