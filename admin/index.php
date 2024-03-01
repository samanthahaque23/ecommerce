<?php
include('../include/connect.php');
include('../function/common-function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Panel</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><b>ETooL</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  

                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if (isset($_SESSION['admin_name'])) {
                            echo "
                        <li class='nav-item'>
                                
                                <a class='text-decoration-none text-dark p-2 text-bold' href=''> $_SESSION[admin_name] </a> </li>
                                <li>
                                <a class='text-decoration-none text-danger text-capitalize p-2' href='index.php?logout'>Logout</a>
                                               </li>";
                        } else {
                            echo "
                      
                                <li>
                                <a class='text-decoration-none text-success text-capitalize' href='index.php?admin_login'>Admin Login</a>
                                               </li>";
                        }
                        ?>

                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_SESSION['admin_name'])) {
        echo "
    <div class='container p-4 text-center'>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='insert-product.php'>insert product</a></button>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?view_products'>view products</a></button>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?insert_category'>insert category</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?view_categories'>view category</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?insert_brands'>insert brands</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?view_brands'>view brands</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?list_order'>all orders</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?all_user'>All Users</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?list_payment'>all payments</a>
    <a class='text-decoration-none m-2 btn btn-outline-success text-capitalize' href='index.php?admin_register'>New Admin Registration</a>

</div>";
    } else {
        echo "
    <h1 class='container text-center text-danger'>
    please login first,if you are not a registered admin,admin have to register to first 
  </h1>
    ";
    }
    ?>


    <div class="container">
        <?php
        if (isset($_GET['insert_category'])) {
            include('insert-categories.php');
        } else if (isset($_GET['insert_brands'])) {
            include('insert-brands.php');
        } else if (isset($_GET['view_products'])) {
            include('view-products.php');
        } else if (isset($_GET['edit_products'])) {
            include('edit-products.php');
        } else if (isset($_GET['delete_products'])) {
            include('delete-products.php');
        } else if (isset($_GET['view_categories'])) {
            include('view-categories.php');
        } else if (isset($_GET['view_brands'])) {
            include('view-brands.php');
        } else if (isset($_GET['edit_category'])) {
            include('edit-category.php');
        } else if (isset($_GET['delete_category'])) {
            include('delete-category.php');
        } else if (isset($_GET['edit_brands'])) {
            include('edit-brands.php');
        } else if (isset($_GET['delete_brands'])) {
            include('delete-brands.php');
        } else if (isset($_GET['list_order'])) {
            include('list-order.php');
        } else if (isset($_GET['list_payment'])) {
            include('list-payment.php');
        } else if (isset($_GET['all_user'])) {
            include('all-user.php');
        } else if (isset($_GET['logout'])) {
            include('admin-logout.php');
        } else if (isset($_GET['admin_login'])) {
            include('admin-login.php');
        } else if (isset($_GET['admin_register'])) {
            include('admin-registration.php');
        }

        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>