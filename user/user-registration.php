<?php
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
    <title>ETool</title>
</head>

<body>
    <div class="container my-3">
        <h2 class="text-center">User Registration Form</h2>
        <div class="row d-flex justify-content-center">
            <div class="w-50">
                <form action="" method="post" enctype="multipart/form-data" class="form">
                    <div class="my-3 from-outline">
                        <label class="form-label" for="username">Username:</label>
                        <input class="form-control" type="text" id="username" name="username">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="user_image">User image:</label>
                        <input class="form-control" type="file" id="user_image" name="user_image">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="confirm_password">Confirm password:</label>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="address">Address:</label>
                        <input class="form-control" type="text" id="address" name="address">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="contact">Contact:</label>
                        <input class="form-control" type="text" id="contact" name="contact">
                    </div>
                    <div class="">
                        <input type="submit" value="Register" class="btn btn-outline-success" name="user-register">
                    </div>
                    <p class="small">Already have an account? <a href="./user-login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php 
if(isset($_POST['user-register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirm_password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $user_image = $_FILES['user_image']['name'];  
    $user_image_tmp = $_FILES['user_image']['tmp_name'];  
    $user_ip = getIPAddress();    //getIPAddress();  it can be used to catch userip if the project goes live. for now,to make a difference between user ip i am adding  numbers
    $select_query = "SELECT * FROM `user` WHERE username = '$username' OR user_email='$email'";

$query_result = mysqli_query($con,$select_query);
$numRows = mysqli_num_rows($query_result);
if($numRows > 0 ){
    echo "<script>alert('this user name or email exists already');</script>";
}elseif($password != $cPassword){
    echo "<script>alert('password does not match with confirm password');</script>";
   
}else{
    move_uploaded_file($user_image_tmp, './user_image/' . $user_image);  // Corrected syntax
    $insert_query = "INSERT INTO `user` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)
                    VALUES ('$username', '$email', '$password', '$user_image', '$user_ip', '$address', '$contact')";

    $sql = mysqli_query($con, $insert_query);
    if($sql){
        echo "<script>alert('User details successfully inserted')</script>";
    }

}
$select_cart_items = "select * from `cartdetail` where ip_address = '$user_ip' ";
$select_cart_items_query = mysqli_query($con,$select_cart_items);
$select_cart_items_rows = mysqli_num_rows($select_cart_items_query);
if($select_cart_items_rows > 0 ){
    $_SESSION['username'] = $username;
    echo "<script>alert('User details successfully inserted')</script>";
    echo "<script>window.open('./user-login.php','_self')</script>";
}else{
    echo "<script>window.open('./user-login.php','_self')</script>";
}
}
   
?>