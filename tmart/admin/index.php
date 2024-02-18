<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['login'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit;
}else { ?>
	
	 <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin - Dashboard</title>
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
                    <li><a href="cart.php">Orders</a></li>
					 <li><a href="logout.php">logout</a></li>
                </ul>
            </div>
        </div>
        <form action="usermanagement.php" method="post">
        <div class="user-container">
            <h1>Hello 🙋<br> Artist TM 👨‍🎨 <br>Here is Your Admin Dashboard😎...</h1>
            
        </div>
        </form>
</body>
</html>
