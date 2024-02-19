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
    <div class="container my-3">
        <h2 class="text-center">User Login Form</h2>
        <div class="row d-flex justify-content-center">
            <div class="w-50">
                <form action="" method="post" enctype="multipart/form-data" class="form ">
                    <div class="my-3 from-outline">
                        <label class="form-label" for="username">Username:</label>
                        <input class="form-control" type="text" id="username" name="username">
                    </div>
                   
                    <div class="my-3 from-outline">
                        <label class="form-label" for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                   
                    <div class="">
                        <input type="submit" value="Login" class="btn btn-outline-success" name="user-login">
                    </div>
                    <p class="small">Don't have an account? <a href="./user-registration.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>