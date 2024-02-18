<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Table</title>
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

<!-- Product Table -->
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
$dbname = "artprints";

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
                    <a href='update.php?productID=".$row['productID']."' class='button edit'>Update</a>
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

</body>
</html>
