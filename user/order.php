<?php
session_start();

include('../include/connect.php');
include('../function/common-function.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cartdetail` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$count_products = mysqli_num_rows($result_cart_price);

$invoice_number = mt_rand();
$status = 'pending';

// Calculate the total price
while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['Product_id'];
    $quantity = $row_price['quantity'];

    $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_product);

    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values * $quantity;
    }
}

// getting quantity from cart 
$get_cart = "SELECT * FROM `cartdetail`";
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

// Insert order into user_order table
$insert_orders = "INSERT INTO `user_order` (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES 
($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);

if ($result_query) {
    // Retrieve the order_id of the inserted order
    $order_id = mysqli_insert_id($con);

    // Loop through each product in the cart
    $result_cart_price = mysqli_query($con, $cart_query_price); // Reset the result set
    while ($row_price = mysqli_fetch_array($result_cart_price)) {
        $product_id = $row_price['Product_id'];
        $quantity = $row_price['quantity'];

        // Insert product details into order_details table
        $insert_order_details = "INSERT INTO `order_details` (order_id, product_id, quantity) VALUES 
        ($order_id, $product_id, $quantity)";
        $result_order_details = mysqli_query($con, $insert_order_details);

        // You can add additional logic here if needed
    }

    // Delete items from cart
    $empty_cart = "DELETE FROM `cartdetail` WHERE ip_address='$get_ip_address'";
    $cart_delete = mysqli_query($con, $empty_cart);

    echo "<script>alert('Order submitted successfully')</script>";
    echo "<script>window.open('user-profile.php', '_self')</script>";
} else {
    echo "<script>alert('Failed to submit order')</script>";
    // Handle the case where the order insertion failed
}

mysqli_close($con);
?>
