<?php
session_start();

include('../include/connect.php');
include('../function/common-function.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>ETool</title>
</head>

<body>
    <?php

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
    }

    $get_ip_address = getIPAddress();
    $total_price = 0;
    $cart_query_price = "Select * from `cartdetail` where ip_address='$get_ip_address'";
    $result_cart_price = mysqli_query($con, $cart_query_price);
    $count_products = mysqli_num_rows($result_cart_price);

    $invoice_number = mt_rand();
    $status = 'pending';
    while ($row_price = mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['Product_id'];
        $select_product = "Select * from `products` where
product_id=$product_id";
        $run_price = mysqli_query($con, $select_product);
        while ($row_product_price = mysqli_fetch_array($run_price)) {
            $product_price = array($row_product_price['price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }



    // getting quantity form cart 
    $get_cart = "select * from `cartdetail`";
    $run_cart = mysqli_query($con, $get_cart);
    $get_item_quantity = mysqli_fetch_array($run_cart);
    $quantity = $get_item_quantity['quantity'];
    if ($quantity == 0) {
        $quantity = 1;
        $subtotal = $total_price;
    } else {

        $quantity = $quantity;
        $subtotal = $total_price * $quantity;
    }
    $insert_orders = "Insert into `user_order` (user_id, amount_due, invoice_number, total_products, order_date, order_status) values 
($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
    $result_query = mysqli_query($con, $insert_orders);
    if ($result_query) {
        echo "<script>alert('order is submitted successfully')</script>";
        echo "<script>window.open('user-profile.php', '_self')</script>";
    }

    // orders pending
    $insert_pending_orders = "Insert into `pending_order` (user_id, invoice_number, product_id, quantity, order_status) values
 ($user_id, $invoice_number, $product_id, $quantity, '$status')";
    $result_pending_orders = mysqli_query($con, $insert_pending_orders);
    // delete items from cart
    $empty_cart = "Delete from `cartdetail` where
ip_address='$get_ip_address'";
$cart_delete = mysqli_query($con,$empty_cart);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>