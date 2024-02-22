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
       <div class='card' style='width: 18rem;'>
           <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
}
function productDetails()
{
    global $con;
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "select * from `products` where product_id=$product_id";
                $result = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];

                    $product_price = $row['price'];
                    $brand_id = $row['brands_id'];
                    $category_id = $row['category_id'];
                    echo " <div class='col-md-4 my-2'>
       <div class='card' style='width: 18rem;'>
           <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
       <img src='./admin/product-images/$product_image3' style='height: 220px;width:200px' class='card-img-top' alt='...'>
       <img src='./admin/product-images/$product_image2' style='height: 220px;width:200px' class='card-img-top' alt='...'>

   </div>";
                }
            }
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
           <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
           <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
               <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
           <img src='./admin/product-images/$product_image1' style='height: 220px;width:200px' class='card-img-top' alt='...'>
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
    return '::1';    //$ip
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
                        echo "<h3 class='text-center'>You have <span class='text-danger'>$row_count</ span>pending orders</h3> </br> 
                    <a href='./user-profile.php?my_orders'>Order Details</a>
                    ";
                    }else{
                        echo "<h3 class='text-center'>You have <span class='text-danger'>0</ span>pending orders</h3></br>
                        <a href='../index.php'>Explore our latest items</a>

                    ";

                    }
                }
            }
        }
    }
}
