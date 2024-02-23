<?php
session_start();
include('../include/connect.php');
include('../function/common-function.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Welcome," . $_SESSION['username'] . "</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 55px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><b>ETooL</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../displayAll.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./user-registration.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup class="sup"><?php cart_item_number()  ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php">Total Price : £<?php total_cart_price(); ?></a>
                    </li>

                </ul>
                <ul class="d-flex navbar-nav me-auto mb-2 mb-lg-0">

                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "  <li class='nav-item'>
                <a class='nav-link' href='../index.php'>Welcome,Guest</a>
</li>";
                    } else {
                        echo "  <li class='nav-item'>
                <a class='nav-link' href='./user-profile.php'>Welcome," . $_SESSION['username'] . "</a>

</li>";
                    }
                    if (!isset($_SESSION['username'])) {
                        echo "  <li class='nav-item'>
    <a class='nav-link' href='./user-login.php'>Login</a>
</li>";
                    } else {
                        echo "  <li class='nav-item'>
    <a class='nav-link' href='./user-logout.php'>Logout</a>
</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    cart();
    ?>


    <!-- product part -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-3 h-100">
                <div class="row h-100">
                    <div class="sidebar h-100">
                        <ul class="profile-list">
                            <?php
                            $username = $_SESSION['username'];
                            $user_image = "select * from `user` where username = '$username'";
                            $connection = mysqli_query($con, $user_image);
                            $row_data = mysqli_fetch_array($connection);
                            $row_image = $row_data['user_image'];
                            echo " <li class='profile-photo'>
                            <img src='./user_image/$row_image' alt=''>
                        </li>";
                            ?>

                            <li class="profile-name">
                                <a href="./user-profile.php"><?php echo $username ?></a>

                            </li>
                            <li class="profile-name">
                                <a href="./user-profile.php?edit_account"> Account Edit
                                </a>
                            </li>
                            <li class="profile-name">
                                <a href="./user-profile.php?user_orders"> My Orders
                                </a>
                            </li>
                            <li class="profile-name">
                                <a href="./user-profile.php?pending_orders"> Pending Orders
                                </a>
                            </li>
                            <li class="profile-name">
                                <a href="./user-profile.php?delete_account"> Account delete
                                </a>
                            </li>
                            <li class="profile-name">
                                <a href="./user-logout.php"> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row d-flex w-100 align-center justify-center">
                    <?php
                    get_user_order_details();
                    if(isset($_GET['edit_account'])){
                        include "user_edit.php";
                    }
                    if(isset($_GET['user_orders'])){
                        include "user_orders.php";
                    }
                    if(isset($_GET['delete_account'])){
                        include "delete-account.php";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        ul {
            list-style: none;
        }

        .row {
            height: calc(100vh - 55px);
        }

        .sidebar {
            background-color: rgb(51 55 61 / 94%);
            color: #fff;
            width: 280px;
            height: 100%;
        }

        .profile-photo img {
            height: 150px;
            width: 100px;
            object-fit: contain;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>