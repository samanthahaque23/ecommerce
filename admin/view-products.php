<?php
include('../include/connect.php');

$get_products = "SELECT * FROM `products`";
$result = mysqli_query($con, $get_products);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>View Products</title>
</head>

<body>
    <h1 class="text-center text-success">View Products</h1>

    <table class="table table-border mt-5">
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['price'];
                $status = $row['status'];
                $number++;

                $get_count = "SELECT SUM(quantity) as total_sold FROM `order_details` WHERE product_id=$product_id";
                $result_count = mysqli_query($con, $get_count);
                $row_count = mysqli_fetch_assoc($result_count);
                $total_sold = $row_count['total_sold'];
            ?>
                <tr class='text-center'>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $product_title; ?></td>
                    <td>
                        <img src='./product-images/<?php echo $product_image1; ?>' style='height:60px' alt='null'>
                    </td>
                    <td><?php echo $product_price; ?></td>
                    <td><?php echo $total_sold; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><a href='index.php?edit_products=<?php echo $product_id; ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_products=<?php echo $product_id; ?>'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
