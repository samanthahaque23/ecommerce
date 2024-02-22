<?php
if (isset($_GET['user_orders'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];

    $select_order_query = "SELECT * FROM `user_order` WHERE user_id='$user_id'";
    $order_result_query = mysqli_query($con, $select_order_query);

    // Check if there are any orders
    if ($order_result_query && mysqli_num_rows($order_result_query) > 0) {
        $order_row_fetch = mysqli_fetch_assoc($order_result_query);
        $order_id = $order_row_fetch['order_id'];

        $invoice_number = $order_row_fetch['invoice_number'];
        $total_products = $order_row_fetch['total_products'];
        $amount_due = $order_row_fetch['amount_due'];
        $order_date = $order_row_fetch['order_date'];
        $order_status = $order_row_fetch['order_status'];
        if ($order_status == 'pending') {
            $order_status = 'incomplete';
        } else {
            $order_status = 'complete';
        }
    } else {
        // Handle the case where no orders are found
        echo "No orders found for the user.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>User Orders</title>
</head>

<body>
    <h1 class="text-center">My Orders</h1>

    <?php
    if (isset($_GET['user_orders'])) {
        // Your existing PHP code

        if ($order_result_query && mysqli_num_rows($order_result_query) > 0) {
            echo '<table class="table table-bordered" >
                   <thead> <tr>
                        <th>Invoice Number</th>
                        <th>Total Products</th>
                        <th>Amount Due</th>
                        <th>Order Date</th>
                        <th>Complete/Incomplete</th>
                        <th>Order Status</th>

                    </tr></thead><tbody>';

            do {
                echo "<tr>
                        <td> $invoice_number </td>
                        <td>$total_products </td>
                        <td>$amount_due</td>
                        <td>$order_date</td>
                        <td>$order_status</td>

                    ";?>
                    <?php 
                    if($order_status =='complete'){
                        echo "<td>Paid</td></tr>";
                    }else{
                        echo " <td>    <a href='confirm-payment.php?order_id=$order_id'>Confirm</a> </td></tr>";
                    }
            } while ($order_row_fetch = mysqli_fetch_assoc($order_result_query));

            echo '</tbody></table>';
        } else {
            // Handle the case where no orders are found
            echo "No orders found for the user.";
        }
    }
    ?>
</body>

</html>