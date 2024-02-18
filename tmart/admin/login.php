<?php
session_start();

$temp_username = "admin@gmail.com";
$temp_password = "admin";

if(isset($_POST["login_submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email === $temp_username && $password === $temp_password) {
        $_SESSION["login"] = $email;
        header("Location: index.php");
        exit;
    } else {
        $_SESSION["login_error"] = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin - Login</title>
</head>
<body>
    <div class="navigation">
        <div class="navbar">
            <div class="logo">
                tm sketchArt.
            </div>
        </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="user-container">
            <h1>Login</h1>
            <?php
                // Check if login attempt was unsuccessful
                if(isset($_SESSION["login"])){
    echo '<h3 class="error">' . $_SESSION["login"] . '</h3>';   
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
                </div>
                <input type="submit" name="login_submit" value="Submit" class="uppercase">
                <input type="reset" value="Reset" class="uppercase">
            </div>
        </div>
    </form>
   
</body>
</html>
