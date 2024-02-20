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
    <!-- product part -->
    <div class="container">
        <div class="products-heading text-center my-4">
            <h2>
                Products
            </h2>
        </div>
        <div class="row">
            <div class="col-3">
                <ul class="text-center list-group">
                    <h4 class="list-group-item">
                        Brands
                    </h4>

                    <?php
                    displayBrands();
                    // $select_brands = "Select * from `brands`";
                    // $result_brands = mysqli_query($con, $select_brands);
                    // while ($row_data = mysqli_fetch_assoc($result_brands)) {
                    //     $brand_title = $row_data['brands_title'];
                    //     $brand_id = $row_data['brands_id'];
                    //     echo "<li class='list-group-item'>
                    // <a href='index.php?brand=$brand_id'>$brand_title</a>
                    // </li>";
                    // }
                    ?>
                </ul>
                <ul class="text-center list-group">
                    <h4 class="list-group-item">
                        Category
                    </h4>
                    <?php
                    getCategories();
                    // $select_categories = "Select * from `categories`";
                    // $result_categories = mysqli_query($con, $select_categories);
                    // while ($row_data = mysqli_fetch_assoc($result_categories)) {
                    //     $category_title = $row_data['category_title'];
                    //     $category_id = $row_data['category_id'];
                    //     echo "<li class='list-group-item'>
                    //     <a href='index.php?category=$category_id'>$category_title</a>
                    // </li>";
                    // }
                    ?>
                </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php
                    getAllProducts();
                    getUniqueCategories();
                    getUniqueBrands();
               
                    ?>
                  
                  
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>