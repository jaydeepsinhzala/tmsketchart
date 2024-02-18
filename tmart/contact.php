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
    <title>Arts Print - Contact</title>
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
          art print.
        </div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="artprints.php">Art Prints</a></li>
          <li><a href="contact.php"  class="active">Contact</a></li>
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
    <div class="contact-container">
        <div class="contact-form">
            <h1>Fill the form</h1>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="message">Your concern</label>
                <textarea name="message" id="message" rows="10"></textarea>
            </div>
            <input type="button" value="Submit" class="uppercase">
        </div>
        <div class="contact-details">
            <h1>Contact Us</h1>
            <p>Art Printe <br>
                    450 Queen Street, <br>
                    Kuripuni, Masterton 5810
            </p>
            <p>
                    +64 (6) 378 8924 <br>
                    <a href="#">hellothere@artprint.com</a>
            </p>
            <p>
                    Mon - Fri 10am - 4:30pm <br>
                    Sat 10am - 3pm <br>
                    Sun CLOSED
            </p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi rerum quam voluptates tenetur id beatae tempore consequatur, sunt provident, maxime optio laboriosam perferendis sed, veniam aliquam quia laudantium ad aliquid sapiente. Reiciendis, fuga vero! Possimus natus blanditiis eius adipisci, quaerat nam fugit aliquam nobis eaque molestiae, quas distinctio atque nemo!</p>

        </div>
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