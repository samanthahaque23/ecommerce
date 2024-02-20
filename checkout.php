<?php
include('include/connect.php');
include('./function/common-function.php');
@session_start();
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
    <?php
    cart();
    ?>
    <!-- product part -->
    <div class="container">
        <div class="products-heading text-center my-4">
           
        </div>
        <div class="row">
          
           <?php
           if(!isset($_SESSION['username'])){
            echo "<script>alert('Login First')</script>";
    echo "<script>window.open('user/user-login.php','_self')</script>";
           }else{
            echo "<script>window.open('user/payment.php','_self')</script>";

           }
           ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>