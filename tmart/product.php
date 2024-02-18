<?php
error_reporting(0);
session_start();
include 'connection.php';
if(isset($_SESSION["product"])) {
    $productID = $_SESSION["product"];
    $sql = "SELECT name, price, description, image FROM product where productID = $productID";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $price = $row["price"];
            $description = $row["description"];
            $image = $row["image"];
        }
    }
    // echo $productID . ' ' . $name;
}
else {
    
}
if(isset($_GET['product'])) {
    $productID = $_GET['pdoructID'];
    $name = $_GET['product'];
    $sql = "SELECT price, description, image FROM product where productID = $productID";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $price = $row["price"];
            $description = $row["description"];
            $image = $row["image"];
        }
    }
    // echo $productID . ' ' . $name;
}
else {
    $message = 'Select a product first';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Arts Print - Product</title>
</head>
<body>
    <div class="navigation">
            <div class="nav-top">
                <ul>
                    <?php 
                        if(isset($_SESSION["customer"])) {
                    ?>
                        <li><a href="logout.php">logout</a></li>
                        <li><span class="dot"></span></li>
                        <li><a href="#"><?php echo $_SESSION["customer"] ; ?></a></li>
                    <?php 
                        } else {
                    ?>
                        <li><a href="login.php">login</a></li>
                        <li><span class="dot"></span></li>
                        <li><a href="register.php">create account</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="navbar">
                <div class="logo">
                    TM SketchArt.
                </div>
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="artprints.php" >Art Prints</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="cart.php">Cart
                        <?php
                        $orderID = $_SESSION["order"];
                         $sql_check2 = "Select cost from orders Where orderID = $orderID";
                         $result_check2 = $conn->query($sql_check2);
                         if ($result_check2->num_rows > 0) {
                             while($row = $result_check2->fetch_assoc()) {
                                 $current_cost = $row["cost"];
                                 echo '(' . $current_cost .')';
                             }
                         }
                        ?>
                    </a></li>
                </ul>
            </div>
        </div>
        <?php 
        if(!isset($_SESSION["product"])) {
            if(isset($message)) {
                echo '<h1 class="produc-display">' . $message . '</h1>';
                header( "refresh:2;url=artprints.php" );
        } else {
         ?>
        <form action="ordermanagement.php" method="post">
            <div class="produc-display">
                <div class="product-image">
                    <img src="./img/<?php echo $image ?>" alt="<?php echo $image ?>">
                </div>
                <div class="product-description">
                    <h1><?php echo '₹' . $price ?></h1>
                    <h2><?php echo $name ?></h2>
                    <p><?php echo $description ?></p>
                    <select name="quan" id="qnau">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" name="product" value="<?php echo $productID ?>">Add to Cart</button>
                </div>
            </div>
        </form>
        <?php } 
        } else { ?>
        <form action="ordermanagement.php" method="post">
            <div class="produc-display">
                <div class="product-image">
                    <img src="./img/<?php echo $image ?>" alt="Product 1">
                </div>
                <div class="product-description">
                    <h1><?php echo '₹' . $price ?></h1>
                    <h2><?php echo $name ?></h2>
                    <p><?php echo $description ?></p>
                    <select name="quan" id="qnau">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" name="product" value="<?php echo $productID ?>">Add to Cart</button>
                    <h3 style="color: #f56342"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></h3>
                </div>
            </div>
        </form>
        <?php unset($_SESSION["product"]); } ?>
        <div class="footer">
                <div class="section">
                    <h1>Customer Care</h1>
                    <div class="footer-link uppercase">
                        <a href="#">Contact US</a><br>
                        <a href="#">faqs</a><br>
                        <a href="#">the story</a><br>
                        <a href="#">store location</a><br>
                        <a href="#">blog</a><br>
                        <a href="#">careers</a><br>
                        <a href="#">terms of use</a><br>
                        <a href="#">shipping</a><br>
                        <a href="#">returns</a><br>
                        <a href="#">privacy policy</a><br>
                    </div>
                </div>
                <div class="section">
                    <h1>About</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis veniam rem quod, quo aliquid culpa magni fugit ducimus et fugiat, vitae deserunt reiciendis, quisquam beatae at dolores sed? Temporibus nesciunt architecto autem, expedita esse facilis natus nostrum non distinctio incidunt. Numquam aspernatur dolorum possimus temporibus culpa esse! Perspiciatis eveniet voluptate totam officia deleniti quia molestiae fuga quam sapiente ratione quidem dolorem aspernatur quisquam repudiandae doloribus fugiat fugit, eaque earum ab.</p>
                </div>
                <div class="section">
                    <h1>Newsletter</h1>
                    <p>Join our mainling list</p>
                    <input type="text" name="email" id="email" placeholder="your@email.com">
                    <button class="uppercase">Subscribe</button>
                </div>
            </div>
            <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
</body>
</html>