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
    <link rel="stylesheet" href="./style.css">
    <title>ETool</title>
    <style>
        .dropdown-toggle {
            display: flex;
            align-items: center;
            margin: 0;
            color: black !important;
        }
        .dropdown-toggle a{
            color: black !important;
        }
        .dropdown-item a{
            color: black;

        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php"><b>ETooL</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./displayAll.php">ALL Products</a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo " <li class='nav-item'>
                    <a class='nav-link' href='./user/user-profile.php'>My Account</a>
                </li>";
                    } else {
                        echo " <li class='nav-item'>
                    <a class='nav-link' href='./user/user-registration.php'>Registration</a>
                </li>";
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i><sup class="sup"><?php cart_item_number()  ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">Total Price : £<?php total_cart_price(); ?></a>
                    </li>
                </ul>
                <form class="d-flex" action="search-product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-data">
                    <button class="btn btn-outline-success" type="submit" name="search-data-btn">
                        <i class="fa-solid fa-magnifying-glass"></i></button>
                </form> 
                        <div class="dropdown m-1">

                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "   <p class=' dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'> 
                <a class='nav-link' href='./index.php'>Welcome,Guest</a>
                <ul class='dropdown-menu ' aria-labelledby='dropdownMenuButton1'>
";
                        } else {
                            echo "   <p class='dropdown-toggle profile-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                <a class='nav-link' href='./user/user-profile.php'>Welcome," . $_SESSION['username'] . "</a>
                <ul class='dropdown-menu ' aria-labelledby='dropdownMenuButton1'>
";
                        }
                        if (!isset($_SESSION['username'])) {
                            echo "  <li class='dropdown-item'>
    <a class='nav-link' href='./user/user-login.php'>Login</a>
</li>";
                        } else {
                            echo "  <li class='dropdown-item'>
    <a class='nav-link' href='./user/user-logout.php'>Logout</a>
</li>";
                        }
                        ?>
                        </div>
                    </div>
            </div>
        </div>
    </nav>
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
                    ?>
                </ul>
                <ul class="text-center list-group">
                    <h4 class="list-group-item">
                        Category
                    </h4>
                    <?php
                    getCategories();
                    ?>
                </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php
                     global $con;
                     if (isset($_GET['product_id'])) {
                         $product_id = $_GET['product_id'];
                 
                         // 1. SQL Injection protection using prepared statements
                         $select_query = "SELECT * FROM `products` WHERE product_id=?";
                         $stmt = mysqli_prepare($con, $select_query);
                         mysqli_stmt_bind_param($stmt, "i", $product_id);
                         mysqli_stmt_execute($stmt);
                         $result = mysqli_stmt_get_result($stmt);
                 
                         // 2. Error handling for database query
                         if (!$result) {
                             die("Query failed: " . mysqli_error($con));
                         }
                 
                         // 3. Check if the result set is not empty
                         if (mysqli_num_rows($result) > 0) {
                             // 4. HTML structure within the while loop
                             while ($row = mysqli_fetch_assoc($result)) {
                                 $product_title = $row['product_title'];
                                 $product_description = $row['product_description'];
                                 $product_image1 = $row['product_image1'];
                                 $product_image2 = $row['product_image2'];
                                 $product_image3 = $row['product_image3'];
                                 $product_price = $row['price'];
                                 $brand_id = $row['brands_id'];
                                 $category_id = $row['category_id'];
                 
                                 echo "<div class='col-md-4 my-2'>
                                         
                                         <div class='card product-card' style='width: 55rem;'>
                                          <div class='product-image d-flex'>
                                          <img src='./admin/product-images/$product_image1' style='height:200px'  class='card-img-top' alt='...'>
                                          <img src='./admin/product-images/$product_image3' style='height:200px'  class='card-img-top' alt='...'>
                                          </div>
                                             <div class='card-body'>
                                                 <h5 class='card-title'>$product_title</h5>
                                                 <h5 class='card-title'>£$product_price</h5>
                                                 <p class='card-text'>$product_description</p>
                                             </div>
                                             <div class='card-body'>
                                                 <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
                                             </div>
                                         </div>
                                        
                                     </div>";
                             }
                         } else {
                             echo "No product found with the given ID.";
                         }
                     }
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