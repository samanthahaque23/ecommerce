<?php
include('include/connect.php');
include('./function/common-function.php')
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
    include('./nav.php');
    ?>
    <nav>
        <div class="text-center">
            Your Store
            <h3>look for your desired gadget</h3>
        </div>
    </nav>
    <?php
    cart();
    ?>
    <div class="container">
        <div class="products-heading text-center my-4">
            <h2>Products</h2>
        </div>
        <div class="row">
            <div class="col-10">
                <?php
                global $con;
                $get_ip_add = getIPAddress();
                $total = 0;

                // Check if the form is submitted
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    foreach ($_POST['quantity'] as $product_id => $quantity) {
                        // Sanitize input values
                        $product_id = mysqli_real_escape_string($con, $product_id);
                        $quantity = mysqli_real_escape_string($con, $quantity);

                        // Update the quantity in the database
                        $update_query = "UPDATE `cartdetail` SET quantity='$quantity' WHERE ip_address='$get_ip_add' AND Product_id='$product_id'";
                        mysqli_query($con, $update_query);
                    }

                    // Check if any products should be removed
                    if (isset($_POST['remove'])) {
                        foreach ($_POST['remove'] as $product_id) {
                            $product_id = mysqli_real_escape_string($con, $product_id);
                            $remove_query = "DELETE FROM `cartdetail` WHERE ip_address='$get_ip_add' AND Product_id='$product_id'";
                            mysqli_query($con, $remove_query);
                        }
                    }
                }

                $cart_query = "SELECT * FROM `cartdetail` WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <form action="" method="post">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Remove</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_array($result)) {
                                    $product_id = $row['Product_id'];
                                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                    $result_products = mysqli_query($con, $select_products);

                                    while ($row_product_price = mysqli_fetch_array($result_products)) {
                                        $product_price = $row_product_price['price'];
                                        $price_table = $row_product_price['price'];
                                        $product_title = $row_product_price['product_title'];
                                        $product_image1 = $row_product_price['product_image1'];
                                        $quantity = $row['quantity'];
                                        $product_values = $product_price * $quantity;
                                        $total += $product_values;
                                ?>
                                        <tr>
                                            <td><?php echo $product_title ?></td>
                                            <td class="cart-img-td"><img class="cart-img" style="height: 70px;object-fit:contain;" src="./admin/product-images/<?php echo $product_image1 ?>" alt="image"></td>
                                            <td><input type="number" name="quantity[<?php echo $product_id; ?>]" class="form-input" value="<?php echo $quantity; ?>"></td>
                                            <td><?php echo $product_values ?></td>
                                            <td><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></td>
                                            <td class="d-flex">
                                                <button type="submit">Update</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Move the submit button outside the loop -->
                        <div class="d-flex">
                            <div>
                                <h4 class="px-3">Subtotal : <strong><?php echo $total ?></strong></h4>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-outline-info m-1">Update Cart</button>
                            </div>
                            <div>
                                <a href="./index.php" class="btn btn-outline-info m-1"> Continue Shopping</a>
                            </div>
                            <div>
                                <a href="./checkout.php" class="btn btn-outline-info m-1"> Checkout</a>
                            </div>
                        </div>
                    </form>
                <?php
                } else {
                    echo "<h2 class='text-center text-danger'>Your cart is empty</h2>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>