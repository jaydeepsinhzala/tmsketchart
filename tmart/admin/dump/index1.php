<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Table</title>
<link rel="stylesheet" href="./css/tables.css">
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

<!-- Add Product Button -->
<button class="button" onclick="location.href='insert_product.php';">Add Product</button>

<!-- Product Table -->
<div class="roombooktable" class="table-responsive-xl">
        <table class="table table-bordered" id="table-data">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>RRP</th>
      <th>Quantity</th>
      <th>Image</th>
      <th>Date Added</th>
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
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["desc"]."</td>
                <td>".$row["price"]."</td>
                <td>".$row["rrp"]."</td>
                <td>".$row["quantity"]."</td>
                <td><img src='./uploads/".$row["img"]."' alt='".$row["name"]."' width='50'></td>
                <td>".$row["date_added"]."</td>
                <td>
                    <a href='delete.php?id=".$row['id']."' class='button delete'>Delete</a>
                    <a href='update.php?id=".$row['id']."' class='button edit'>Update</a>
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
</body>
</html>
