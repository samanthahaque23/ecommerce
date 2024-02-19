  
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>ETooL</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./displayAll.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i><sup class="sup"><?php  cart_item_number()  ?></sup></a>
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
            </div>
        </div>
    </nav>
    <?php
    cart();
    ?>