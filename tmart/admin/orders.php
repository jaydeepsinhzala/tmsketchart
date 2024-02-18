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

// Execute the SQL query
$sql = "SELECT 
            o.orderID,
            o.customer,
            o.orderDate,
            po.productID,
            p.name AS productName,
            po.cost AS productCost,
            p.price AS unitPrice,
            (po.quantity * p.price) AS totalPrice
        FROM 
            orders o
        JOIN 
            productordered po ON o.orderID = po.orderID
        JOIN 
            product p ON po.productID = p.productID";

// Execute the SQL query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo "Error: " . $conn->error;
} else {
    // Output data of each row
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Output rows
        }
    } else {
        echo "No orders found";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Orders</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Orders Information</h2>
<table>
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Order Date</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Cost</th>
        <th>Unit Price</th>
        <th>Total Price</th>
    </tr>
    <?php
    // Output data of each row
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["orderID"]."</td>
                    <td>".$row["customer"]."</td>
                    <td>".$row["orderDate"]."</td>
                    <td>".$row["productID"]."</td>
                    <td>".$row["productName"]."</td>
                    <td>".$row["productCost"]."</td>
                    <td>".$row["unitPrice"]."</td>
                    <td>".$row["totalPrice"]."</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No orders found</td></tr>";
    }
    ?>
</table>

</body>
</html>


