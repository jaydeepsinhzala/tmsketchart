<?php
session_start();
if(isset($_SESSION["register"])){
    $register_message = "Registration successful! Please login now";
}
if(isset($_SESSION["customer"]) || isset($_SESSION["admin"])) {
    header("Location: index.php");
    // echo $_SESSION["customer"];
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
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="user-container">
        <h1>Login</h1>
        <?php
            // Check if login attempt was unsuccessful
            if(isset($_SESSION["login"])){
                echo '<h3 class="error">' . $_SESSION["login"] . '</h3>';
                unset($_SESSION["login"]);   
            }
        ?>
        <div class="user-form">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <input type="checkbox" onclick="myFunction()"><span>Show Password</span>
                <a href="forgot.php">Forgot password?</a>
            </div>
            <input type="submit" name="login_submit" value="Submit" class="uppercase">
            <input type="reset" value="Reset" class="uppercase">
        </div>
    </div>
</form>
<?php

// Define temp username and password
$temp_username = "admin@gmail.com";
$temp_password = "admin";

if(isset($_POST["login_submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email === $temp_username && $password === $temp_password) {
        $_SESSION["username"] = $email;
        header("Location: Dashboard.php");
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>
        
</body>
</html>