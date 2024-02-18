<?php
session_start();
if(isset($_SESSION["customer"]) || isset($_SESSION["admin"])) {
    header("Location: index.php");
    // echo $_SESSION["customer"];
}
//add below code anywhere you want show error
if($error){
    echo $error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Arts Print - Login</title>
</head>
<body>
    <div class="navigation">
            <div class="nav-top">
                <ul>
                    <li><a href="login.php">login</a></li>
                    <li><span class="dot"></span></li>
                    <li><a href="register.php">create account</a></li>
                </ul>
            </div>
            <div class="navbar">
                <div class="logo">
                    art print.
                </div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="artprints.php">Art Prints</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </div>
        </div>
        <form action="usermanagement.php" method="post">
        <div class="user-container">
            <h1>Login</h1>
            <?php
                if(isset($register_message)){
                    echo '<h3 class="success">' . $register_message . '</h3>';
                    unset($_SESSION["register"]);   
                }
                if(isset($_SESSION["login"])){
                    echo '<h3 class="error">' . $_SESSION["login"] . '</h3>';
                    unset($_SESSION["login"]);   
                }
                if(isset($_SESSION["success"])) {
                    echo '<h3 class="success">' . $_SESSION["success"] . '</h3>';
                    unset($_SESSION["success"]);
                    // echo 'hello';
                }
            ?>
            <div class="user-form">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" required>
                    <input type="checkbox" onclick="myFunction()"><span>Show Password</span>
                    <a href="forgot.php">forgot password?</a>
                </div>
                <input type="submit" name="login" value="Submit" class="uppercase">
                <input type="reset" value=" Reset" class="uppercase">
            </div>
        </div>
        </form>
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