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
            <a class="navbar-brand" href="#"><b>ETooL</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">Admin Name</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <div class="container p-4">
        <button class="btn btn-outline-success"><a href="insert-product.php">insert product</a></button>
        <button class="btn btn-outline-success">view product</button>
        <a class="text-decoration-none btn btn-outline-success" href="index.php?insert_category">insert category</a>
        <button class="btn btn-outline-success"> view category</button>
        <a class="text-decoration-none btn btn-outline-success" href="index.php?insert_brands">insert brands</a>
        <button class="btn btn-outline-success"> view brands</button>
        <button class="btn btn-outline-success">all orders</button>
        <button class="btn btn-outline-success">all users</button>
        <button class="btn btn-outline-success">all payment</button>
        <button class="btn btn-outline-success">logout</button>
    </div>

    <div class="container">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert-categories.php');
        }
        else if(isset($_GET['insert_brands'])){
            include('insert-brands.php');
        }
        
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>