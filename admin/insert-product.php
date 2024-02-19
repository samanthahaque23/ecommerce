<?php
include('../include/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    $product_status = "true";


    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    if (
        $product_title == '' or $product_category == '' or $product_description == '' or $product_brand == '' or
        $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == ''
    ) {
        echo "<script>alert('please fill all the required fields');</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product-images/$product_image1");
        move_uploaded_file($temp_image2,"./product-images/$product_image2");
        move_uploaded_file($temp_image3,"./product-images/$product_image3");
        $insert_product = "insert into `products` (product_title,product_description,product_keyword,category_id,
        brands_id,product_image1,product_image2,product_image3,price,date,status) values ('$product_title','$product_description','$product_keywords',
        '$product_category','$product_brand', '$product_image1', '$product_image2', '$product_image3','$product_price',NOW(),'$product_status')";

        $result = mysqli_query($con,$insert_product);
        if($result){
        echo "<script>alert('successfully inserted in the products table');</script>";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Panel-insert product</title>
</head>

<body>

    <div class="container d-flex w-100 justify-content-center align-items-center my-3">
        <div class="card" style="width:50% ;border: 2px solid rgb(16, 44, 1)">
            <h2 class="text-center p-3">Insert Product</h2>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">

            <div class="form-outline m-4">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" name="product_title" id="product_title" placeholder="enter product name" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <label for="product_description" class="form-label">Product Description</label>
                    <input type="text" name="product_description" id="product_description" placeholder="enter product description" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <label for="product_keywords" class="form-label">Product Keywords</label>
                    <input type="text" name="product_keywords" id="product_keywords" placeholder="enter product keywords" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                <select name="product_category" class="form-select">
                    <option value="">select a category</option>
                    <?php
                    $select_categories = "Select * from `categories`";
                    $result_categories = mysqli_query($con, $select_categories);
                    while ($row_data = mysqli_fetch_assoc($result_categories)) {
                        $category_title = $row_data['category_title'];
                        $category_id = $row_data['category_id'];
                        echo "  <option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline m-4">
                <select name="product_brand" class="form-select">
                    <option value="">select a brands</option>
                    <?php
                    $select_brands = "Select * from `brands`";
                    $result_brands = mysqli_query($con, $select_brands);
                    while ($row_data = mysqli_fetch_assoc($result_brands)) {
                        $brands_title = $row_data['brands_title'];
                        $brands_id = $row_data['brands_id'];
                        echo "  <option value='$brands_id'>$brands_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline m-4">
                    <label for="product_image1" class="form-label">Product Image 1</label>
                    <input type="file" name="product_image1" id="product_image1" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <label for="product_image2" class="form-label">Product Image 2</label>
                    <input type="file" name="product_image2" id="product_image2" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <label for="product_image3" class="form-label">Product Image 3</label>
                    <input type="file" name="product_image3" id="product_image3" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="text" name="product_price" id="product_price" placeholder="enter product price" class="form-control" autocomplete="off">
            </div>
            <div class="form-outline m-4">
                    <input type="submit" name="insert_product" class="btn btn-success" value="insert_product">
            </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>