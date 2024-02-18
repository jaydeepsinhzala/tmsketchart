<?php
error_reporting(E_ALL);
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
    <style></style>
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
                    <li><a href="#"><?php echo $_SESSION["customer"]; ?></a></li>
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
                        if(isset($_SESSION["order"])) {
                            $orderID = $_SESSION["order"];
                            $sql_check2 = "SELECT cost FROM orders WHERE orderID = ?";
                            $stmt = $conn->prepare($sql_check2);
                            $stmt->bind_param("i", $orderID);
                            $stmt->execute();
                            $result_check2 = $stmt->get_result();
                            if ($result_check2->num_rows > 0) {
                                while($row = $result_check2->fetch_assoc()) {
                                    $current_cost = $row["cost"];
                                    echo '(' . $current_cost . ')';
                                }
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

    <div class="container">
    <?php
    // Check if the search parameter is set
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        
        // SQL query to fetch products based on the search keyword
        $sql = "SELECT * FROM product WHERE name LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%$search%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {    
    ?>
            <h1 class="slogan">Search Results for "<?php echo $search; ?>"</h1>
            <div class="product-showcase" id="search-results">
    <?php
                while($row = $result->fetch_assoc()) {
    ?>
                    <div class="product">
                        <img src="./img/<?php echo $row["image"]; ?>" alt="" />
                        <h2><?php echo $row["name"]; ?></h2>
                        <p><?php echo '₹' . $row["price"]; ?></p>
                        <form action="product.php" method="get">
                            <input type="hidden" name="pdoructID" value="<?php echo $row["productID"]; ?>">
							<button type="submit" name="product" value="<?php echo $row["name"]; ?>">Buy</button>
                        </form>
                    </div>
    <?php 
                }
    ?>
            </div>
    <?php
        } else {
            echo "<p>No products found matching your search.</p>";
        }
    }
    ?>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>
