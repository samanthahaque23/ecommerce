<?php
// include('./include/connect.php');

function getProducts()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "select * from `products` LIMIT 0,6";
            $result = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['price'];
                $brand_id = $row['brands_id'];
                $category_id = $row['category_id'];
                echo " <div class='col-md-4 my-2'>
       <div class='card product-card' style='width: 18rem;'>
       <div class='product-image'>
       <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
       </div>
           <div class='card-body'>
               <h5 class='card-title'>$product_title</h5>
               <h5 class='card-title'>£$product_price</h5>
           </div>
           <div class='card-body'>
               <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
               <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
           </div>
       </div>
   </div>";
            }
        }
    }
}
function productDetails()
{
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
                        <div class='card' style='width: 18rem;'>
                        <div class='card product-card' style='width: 18rem;'>
                         <div class='product-image'>
                         <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
                         </div>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <h5 class='card-title'>£$product_price</h5>
                                <p class='card-text'>$product_description</p>
                            </div>
                            <div class='card-body'>
                                <a href='#' class='card-link'>Add to cart</a>
                                <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
                            </div>
                        </div>
                        <img src='./admin/product-images/$product_image2' style='height: 220px;width:200px' class='card-img-top' alt='...'>
                        <img src='./admin/product-images/$product_image3' style='height: 220px;width:200px' class='card-img-top' alt='...'>
                    </div>";
            }
        } else {
            echo "No product found with the given ID.";
        }
    }
}

function getAllProducts()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "select * from `products` order by rand()";
            $result = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['price'];
                $brand_id = $row['brands_id'];
                $category_id = $row['category_id'];
                echo " <div class='col-md-4 my-2'>
       <div class='card' style='width: 18rem;'>
       <div class='product-image'>
       <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
       </div>
           <div class='card-body'>
               <h5 class='card-title'>$product_title</h5>
               <h5 class='card-title'>£$product_price</h5>

           </div>
           <div class='card-body'>
           <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
           <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
           </div>
       </div>
   </div>";
            }
        }
    }
}
function getUniqueCategories()
{
    global $con;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        $select_query = "select * from `products` where category_id = $category_id";
        $result = mysqli_query($con, $select_query);
        $number_of_rows = mysqli_num_rows($result);
        if ($number_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No Stock For This Category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['price'];
            $brand_id = $row['brands_id'];
            $category_id = $row['category_id'];
            echo " <div class='col-md-4 my-2'>
       <div class='card' style='width: 18rem;'>
       <div class='product-image'>
       <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
       </div>
           <div class='card-body'>
               <h5 class='card-title'>$product_title</h5>
               <h5 class='card-title'>£$product_price</h5>

               <p class='card-text'>$product_description</p>
           </div>
           <div class='card-body'>
           <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
           <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
           </div>
       </div>
   </div>";
        }
    }
}

function getUniqueBrands()
{
    global $con;
    if (isset($_GET['brand'])) {
        $brands_id = $_GET['brand'];

        $select_query = "select * from `products` where brands_id = $brands_id";
        $result = mysqli_query($con, $select_query);
        $number_of_rows = mysqli_num_rows($result);
        if ($number_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No Stock For This Brand</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['price'];
            $brand_id = $row['brands_id'];
            $category_id = $row['category_id'];
            echo " <div class='col-md-4 my-2'>
           <div class='card' style='width: 18rem;'>
           <div class='product-image'>
           <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
           </div>
               <div class='card-body'>
                   <h5 class='card-title'>$product_title</h5>
               <h5 class='card-title'>£$product_price</h5>

                   <p class='card-text'>$product_description</p>
               </div>
               <div class='card-body'>
               <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
               <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
               </div>
           </div>
       </div>";
        }
    }
}

function displayBrands()
{
    global $con;
    $select_brands = "Select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brands_title'];
        $brand_id = $row_data['brands_id'];
        echo "<li class='list-group-item'>
    <a href='index.php?brand=$brand_id'>$brand_title</a>
    </li>";
    }
}

function getCategories()
{
    global $con;
    $select_categories = "Select * from `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='list-group-item'>
        <a href='index.php?category=$category_id'>$category_title</a>
    </li>";
    }
}
function getSearchedData()
{
    global $con;

    if (isset($_GET['search-data-btn'])) {
        $user_search = $_GET['search-data'];
        $search_query = "select * from `products` where product_title like '%$user_search%'";
        $result = mysqli_query($con, $search_query);
        $number_of_rows = mysqli_num_rows($result);
        if ($number_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No Stock For This Search</h2>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['price'];
            $brand_id = $row['brands_id'];
            $category_id = $row['category_id'];
            echo " <div class='col-md-4 my-2'>
       <div class='card' style='width: 18rem;'>
       <div class='product-image'>
       <img src='./admin/product-images/$product_image1'  class='card-img-top' alt='...'>
       </div>
           <div class='card-body'>
               <h5 class='card-title'>$product_title</h5>
               <h5 class='card-title'>£$product_price</h5>

               <p class='card-text'>$product_description</p>
           </div>
           <div class='card-body'>
           <a href='index.php?addedToCart=$product_id' class='card-link'>Add to cart</a>
           <a href='product-details.php?product_id=$product_id' class='card-link'>View More</a>
           </div>
       </div>
   </div>";
        }
    }
}

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return '5';    //$ip
}

function cart()
{
    global $con;

    if (isset($_GET['addedToCart'])) {
        $getIP = getIPAddress();
        $get_product_id = $_GET['addedToCart'];
        $select_query = "select * from `cartdetail` where ip_address='$getIP' and Product_id='$get_product_id'";
        $result = mysqli_query($con, $select_query);
        $number_of_rows = mysqli_num_rows($result);
        if ($number_of_rows > 0) {
            echo "<script>alert('this product is already present in the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert = "insert into `cartdetail` (Product_id,ip_address,quantity) values ('$get_product_id','$getIP',1)";
            $result = mysqli_query($con, $insert);
            echo "<script>alert('added to the cart')</script>";
        }
    }
}
function cart_item_number()
{
    if (isset($_GET['addedToCart'])) {
        global $con;
        $getIP = getIPAddress();
        $select_query = "select * from `cartdetail` where ip_address='$getIP'";
        $result = mysqli_query($con, $select_query);
        $countCartItem = mysqli_num_rows($result);
    } else {
        global $con;
        $getIP = getIPAddress();
        $select_query = "select * from `cartdetail` where ip_address='$getIP'";
        $result = mysqli_query($con, $select_query);
        $countCartItem = mysqli_num_rows($result);
    }
    echo $countCartItem;
}
function total_cart_price()
{
    global $con;
    $get_ip_add = getIPAddress();
    $total = 0;
    $cart_query = "Select * from `cartdetail` where ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['Product_id'];
        $select_products = "Select * from `products` where product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }
    echo $total;
}

function get_user_order_details()
{
    global $con;
    $username = $_SESSION['username'];
    $get_details = "Select * from `user` where username='$username'";
    $result_query = mysqli_query($con, $get_details);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['user_orders'])) {
                if (!isset($_GET['delete_account'])) {

                    $get_orders = "Select * from `user_order` where user_id=$user_id and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo " 
                        <div class='d-flex justify-content-center align-items-center'>
<div>
<h3 class='text-center'>You have <span class='text-danger'>$row_count</ span>pending orders</h3> </br>
<a class='btn btn-outline-info order-btn' href='./user-profile.php?user_orders'>Order Details</a>

</div>                        
                        </div>                    ";
                    } else {
                        echo "<h3 class='text-center'>You have <span class='text-danger'>0</ span>pending orders</h3></br>
                                  <div>
                        <a class ='btn btn-outline-success form-control text-center text-decoration-none' href='../index.php'><h3>Explore our latest items</h3></a>
                                  
                                  </div>
                    ";
                    }
                }
            }
        }
    }
}
