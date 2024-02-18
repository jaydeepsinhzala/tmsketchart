<?php
session_start();
include 'connection.php';
if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "INSERT INTO user (email, name, password)
            VALUES ('$email', '$name', '$pass')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    $_SESSION["register"] = "yes";
    // echo $name . ' ' . $email . ' ' . $pass;
    header("Location: login.php");
}
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT name, userType FROM user where email = '$email' AND password = '$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userType = $row["userType"];
            $name = $row["name"];
            // echo $userType . " " . $name;
            if($userType = "customer"){
                // echo 'You are a customer';
                $_SESSION["customer"] = $name;
                $_SESSION["customer_email"] = $email;  
            }
            else {
                $_SESSION["admin"] = $name;
                $_SESSION["admin_email"] = $email;
            }
        }
        header("Location: index.php");
        // echo $_SESSION["customer"];
    }
    else {
        $sql = "SELECT * FROM user where email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION["login"] = "Please enter correct password";
        } else {
            $_SESSION["login"] = "Register/Put right mail address";
        }
        header("Location: login.php");
    }
}
if(isset($_POST['resetPassword'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm-password'];
    if($pass != $confirmPass) {
        $_SESSION["error_pass"] = "Passwords do not match";
        header("Location: forgot.php");
    } else {
        $sql_update = "Update user SET password = '$pass' Where email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            $_SESSION['success'] = "Password updated";
            header("Location: login.php");
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    }
}
?>