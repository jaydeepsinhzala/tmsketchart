<?php
error_reporting(0);
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Arts Print - Arts</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="artprints.php" class="active">Art Prints</a></li>
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
					<li>
									   <form action="search.php" method="get">
						<input type="search" name="search" pattern=".*\S.*" required>
						<button type="submit">Search</button>
					</form>

                </li>
            </ul>
        </div>
    </div>
    <div class="header">
        <div class="text-on-image">
            <p class="uppercase">Art Prints <br>
                the best is here</p>
        </div>
        <div class="container">
            <div class="next-section" id="section-change-main">
                <div class="next-sub uppercase" id="section-change">
                    <a href="#all-products"><img src="./img/arrow-down.png" alt="arrow-down"></a>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $sql = "SELECT SUM(qnatity) AS productSold, product.productID, name, artist, price, image FROM product inner join productordered on product.productID = productordered.productID group by productordered.productID order by productSold DESC LIMIT 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {    
    ?>
    <h1 class="slogan">Most Popular</h1>
    <div class="product-showcase" id="featured">
    <?php
            while($row = $result->fetch_assoc()) {
      ?>
      <form action="product.php" method="get">
        <div class="product">
          <img src="./img/<?php echo $row["image"]; ?>" alt="" />
          <h2><?php echo $row["name"]; ?></h2>
          <p><?php echo '₹' . $row["price"]; ?></p>
          <input type="hidden" name="pdoructID" value="<?php echo $row["productID"]; ?>">
          <button type="submit" name="product" value="<?php echo $row["name"]; ?>">Buy</button>
        </div>
      </form>
      <?php } ?>
    </div>
    <?php } ?>
    <div class="product-showcase" id="all-products">
            <h1 class="slogan">Browse our catalouge</h1>
            <?php
            $sql = "SELECT productID, name,	price, image FROM product";
            if(isset($_GET['filter'])) {
                $artist = $_GET['productID'];
                if($artist != 1) {
                     $sql = "SELECT productID, name, price, image FROM product";
                }
                else {
                    $sql = "SELECT productID, name,	price, image FROM product";
                }
            }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
      ?>
      <form action="product.php" method="get">
        <div class="product">
          <img src="./img/<?php echo $row["image"]; ?>" alt="" />
          <h2><?php echo $row["name"]; ?></h2>
          <p><?php echo $row["artist"]; ?></p>
          <p><?php echo '₹' . $row["price"]; ?></p>
          <input type="hidden" name="pdoructID" value="<?php echo $row["productID"]; ?>">
          <button type="submit" name="product" value="<?php echo $row["name"]; ?>">Buy</button>
        </div>
      </form>
      <?php } } ?>
        </div>
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