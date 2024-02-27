<?php

if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keyword'];
    $category_id = $row['category_id'];
    $brand_id = $row['brands_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['price'];
}

// fetching category name
$select_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
$result_category = mysqli_query($con, $select_category);
$row_category = mysqli_fetch_assoc($result_category);
$category_title = ($row_category) ? $row_category['category_title'] : '';

// fetching brand name
$select_brands = "SELECT * FROM `brands` WHERE brands_id=$brand_id";
$result_brands = mysqli_query($con, $select_brands);
$row_brands = mysqli_fetch_assoc($result_brands);
$brands_title = ($row_brands) ? $row_brands['brands_title'] : '';
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title ?>" name="product_title" class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label"> Product Description</label>
            <input type="text" id="product_desc" value="<?php echo $product_description ?>" name="product_description" class="form-control">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keyword" class="form-label"> Product Keyword</label>
            <input type="text" id="product_keyword" value="<?php echo $product_keywords ?>" name="product_keyword" class="form-control">
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image1</label>
            <div class="d-flex">
                <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto">
                <img src="./product-images/<?php echo $product_image1 ?>" style="height: 80px;" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image2</label>
            <div class="d-flex">
                <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto">
                <img src="./product-images/<?php echo $product_image2 ?>" style="height: 80px;" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image3</label>
            <div class="d-flex">
                <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto">
                <img src="./product-images/<?php echo $product_image3 ?>" style="height: 80px;" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Categories</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $row_category_all['category_title'];
                    $category_id = $row_category_all['category_id'];
                    echo " <option value='$category_id'>$category_title</option>";
                };
                ?>
            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label">Product Brands</label>
            <select name="product_brands" class="form-select">
                <option value="<?php echo $brands_title ?>"><?php echo $brands_title ?></option>
                <?php
                $select_brands_all = "SELECT * FROM `brands`";
                $result_brands_all = mysqli_query($con, $select_brands_all);
                while ($row_brands_all = mysqli_fetch_assoc($result_brands_all)) {
                    $brands_title = $row_brands_all['brands_title'];
                    $brands_id = $row_brands_all['brands_id'];
                    echo " <option value='$brands_id'>$brands_title</option>";
                };
                ?>
            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label"> Product Price</label>
            <input type="text" id="product_price" value="<?php echo $product_price ?>" name="product_price" class="form-control">
        </div>

        <div class="w-50 m-auto mb-4">
            <input type="submit" id="update_product" value="Update Product" name="update_product" class="btn btn-outline-success">
        </div>
    </form>
</div>

<?php
if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_description'];
    $product_keywords = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    // Check if new images are uploaded for product_image1
    if ($_FILES['product_image1']['size'] > 0) {
        $product_image1 = $_FILES['product_image1']['name'];
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        move_uploaded_file($temp_image1, "./product-images/$product_image1");
    } else {
        // Preserve existing image if no new image is uploaded
        $product_image1 = $product_image1;
    }

    if ($_FILES['product_image2']['size'] > 0) {
        $product_image2 = $_FILES['product_image2']['name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        move_uploaded_file($temp_image2, "./product-images/$product_image2");
    } else {
        // Preserve existing image if no new image is uploaded
        $product_image2 = $product_image2;
    }
    if ($_FILES['product_image3']['size'] > 0) {
        $product_image3 = $_FILES['product_image3']['name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];
        move_uploaded_file($temp_image3, "./product-images/$product_image3");
    } else {
        // Preserve existing image if no new image is uploaded
        $product_image3 = $product_image3;
    }

    // query to update products
    $update_product = "UPDATE `products` SET 
        product_title='$product_title', 
        product_description='$product_desc', 
        product_keyword='$product_keywords', 
        category_id='$product_category', 
        brands_id='$product_brands',
        product_image1='$product_image1',
        product_image2='$product_image2',
        product_image3='$product_image3',
        price='$product_price',
        date=NOW() 
        WHERE product_id=$edit_id";

    $result_update = mysqli_query($con, $update_product);

    if ($result_update) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('./index.php?view_products', '_self')</script>";
    }
}
?>
