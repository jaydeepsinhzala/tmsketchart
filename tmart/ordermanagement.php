<?php
session_start();
include 'connection.php';
$customer  = $_SESSION["customer"];
$email = $_SESSION["customer_email"];
$orderDate = date("Y/m/d");
// echo $orderDate;
if(isset($_POST['product'])) {
    $productID = $_POST['product'];
    $quan = $_POST['quan'];
    if(!isset($_SESSION["customer"])) {
        $_SESSION["error"] = "Please login before purchase";
        $_SESSION["product"] = $productID;
        header("Location: product.php");
    } else {
    $sql_price = "Select price from product where productID = $productID";
    $result_price = $conn->query($sql_price);
        if ($result_price->num_rows > 0) {
            while($row = $result_price->fetch_assoc()) {
                $price = $row["price"];
                $product_cost = $quan * $price;
                // echo $price . ' ' . $product_cost;
            }
        }
        else {
                //DO NOTHING
        }
    // echo $productID . ' ' . $quan;
    if(isset($_SESSION["order"])) {
        $orderID = $_SESSION["order"];
        $sql_check2 = "Select cost from orders Where orderID = $orderID";
        $result_check2 = $conn->query($sql_check2);
        if ($result_check2->num_rows > 0) {
            while($row = $result_check2->fetch_assoc()) {
                $current_cost = $row["cost"];
                $cost_update = $current_cost + $product_cost;
                $final_cost_update = $cost_update * 1.05;
            }
        }
        $sql_check = "Select qnatity, cost from productordered Where orderID = $orderID AND productID = $productID";
        $result_check = $conn->query($sql_check);
        if ($result_check->num_rows > 0) {
            while($row = $result_check->fetch_assoc()) {
                $order_quan = $row["qnatity"];
                $total_quan = $quan + $order_quan;
                $new_cost = $total_quan * $price;
                $new_cost_total = $new_cost * 1.05;
                if(($order_quan > 4) || ($total_quan > 5)) {
                    $_SESSION["error"] = "Maximum quantity limit reached (Max 5 items/Order)";
                    $_SESSION["product"] = $productID;
                    header("Location: product.php");
                    // echo $_SESSION["product"];
                }
                else {
                    $sql_update = "Update productordered SET qnatity = $total_quan, cost= $new_cost Where orderID = $orderID AND productID = $productID";
                    if ($conn->query($sql_update) === TRUE) {
                        // echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql_update . "<br>" . $conn->error;
                    }
                    $sql_update2 = "Update orders SET cost = $cost_update, totalAmount= $final_cost_update Where orderID = $orderID";
                    if ($conn->query($sql_update2) === TRUE) {
                        // echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql_update2 . "<br>" . $conn->error;
                    }
                    header("Location: cart.php");
                }
            }
        } else {
            $sql_insert4 = "INSERT INTO productordered (orderID, productID, qnatity, cost)
            VALUES ($orderID, $productID, $quan, $product_cost)";
                if ($conn->query($sql_insert4) === TRUE) {
                    // echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_insert4 . "<br>" . $conn->error;
                }
                $sql_update3 = "Update orders SET cost = $cost_update, totalAmount= $final_cost_update Where orderID = $orderID";
                    if ($conn->query($sql_update3) === TRUE) {
                        // echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql_update3 . "<br>" . $conn->error;
                    }
                    header("Location: cart.php");
                
        }
        // unset($_SESSION["order"]);
    } else {
        $sql_select = "Select MAX(orderid) AS highest from orders";
        $result = $conn->query($sql_select);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["order"] = $row["highest"] + 1;
                $orderID = $_SESSION["order"];
                $final_amount = $product_cost * 1.05;
                $sql_insert = "INSERT INTO orders (orderID, customer, cost, totalAmount, orderDate)
            VALUES ($orderID, '$email', $product_cost, $final_amount, '$orderDate')";
                if ($conn->query($sql_insert) === TRUE) {
                    // echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                }
                $sql_insert2 = "INSERT INTO productordered (orderID, productID, qnatity, cost)
            VALUES ($orderID, $productID, $quan, $product_cost)";
                if ($conn->query($sql_insert2) === TRUE) {
                    // echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_insert2 . "<br>" . $conn->error;
                }
                // unset($_SESSION["order"]);
            }
            header("Location: cart.php");
        }
        else {

        }
             
        }
    }
}
if(isset($_POST['cartUpdate'])) {
    $productID = $_POST['cartUpdate'];
    $quan = $_POST['quan'];
    $orderID = $_SESSION["order"];
    if($quan <= 0) {
        $_SESSION["error"] = "Select items more than or equal to 0";
                header("Location: cart.php");
    } else {
        $sql_price = "Select qnatity, price from product inner join productordered on product.productID = productordered.productID where product.productID = $productID";
        $result_price = $conn->query($sql_price);
        if ($result_price->num_rows > 0) {
            while($row = $result_price->fetch_assoc()) {
                $price = $row["price"];
                $available_quan = $row["qnatity"];
                $product_cost = $quan * $price;
                $product_cost_final = ($quan-$available_quan) * $price;
                // echo $price . ' ' . $product_cost;
            }
        }
        else {
                //DO NOTHING
        }
            $sql_check2 = "Select cost from orders Where orderID = $orderID";
            $result_check2 = $conn->query($sql_check2);
            if ($result_check2->num_rows > 0) {
                while($row = $result_check2->fetch_assoc()) {
                    $current_cost = $row["cost"];
                    $cost_update = $current_cost + $product_cost_final;
                    $final_cost_update = $cost_update * 1.05;
                }
            }
            // echo $productID . ' ' . $quan;
            if($quan > 5) {
                $_SESSION["error"] = "Limit is 5 items/order";
                header("Location: cart.php");
            } else {
            $sql_update = "Update productordered SET qnatity = $quan, cost= $product_cost Where orderID = $orderID AND productID = $productID";
            if ($conn->query($sql_update) === TRUE) {
                // echo "New record created successfully";
            } else {
                echo "Error: " . $sql_update . "<br>" . $conn->error;
            }
            $sql_update2 = "Update orders SET cost = $cost_update, totalAmount= $final_cost_update Where orderID = $orderID";
            if ($conn->query($sql_update2) === TRUE) {
                // echo "New record created successfully";
            } else {
                echo "Error: " . $sql_update2 . "<br>" . $conn->error;
            }
            header("Location: cart.php");
        }
    }
}
if(isset($_POST['remove'])) {
    $orderID = $_SESSION["order"];
    $productID = $_POST['remove'];
    $sql_check = "Select cost from productordered WHERE orderID = $orderID AND productID = $productID";
    $result_check = $conn->query($sql_check);
    if ($result_check->num_rows > 0) {
        while($row = $result_check->fetch_assoc()) {
            $product_cost = $row["cost"];
        }
    }
    $sql_check2 = "Select cost from orders Where orderID = $orderID";
    $result_check2 = $conn->query($sql_check2);
    if ($result_check2->num_rows > 0) {
        while($row = $result_check2->fetch_assoc()) {
            $current_cost = $row["cost"];
            $cost_update = $current_cost - $product_cost;
            $final_cost_update = $cost_update * 1.05;
        }
    }
    $sql_update = "Update orders SET cost = $cost_update, totalAmount= $final_cost_update Where orderID = $orderID";
    if ($conn->query($sql_update) === TRUE) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
    header("Location: cart.php");
    $sql_delete = "DELETE FROM productordered WHERE orderID = $orderID AND productID = $productID";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: cart.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>