<?php
include('../include/connect.php');
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
        <h2 class="text-center">Admin Registration Form</h2>
        <div class="row d-flex justify-content-center">
            <div class="w-50">
                <form action="" method="post" enctype="multipart/form-data" class="form">
                    <div class="my-3 from-outline">
                        <label class="form-label" for="admin_name">Admin name:</label>
                        <input class="form-control" type="text" id="admin_name" name="admin_name">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>
                    <div class="my-3 from-outline">
                        <label class="form-label" for="admin_image">Admin image:</label>
                        <input class="form-control" type="file" id="admin_image" name="admin_image">
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
                        <input type="submit" value="Register" class="btn btn-outline-success" name="admin-register">
                    </div>
                    <p class="small">Already have an account? <a href="./admin-login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

<?php 
if(isset($_POST['admin-register'])){
    $admin_name = $_POST['admin_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirm_password'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $admin_image = $_FILES['admin_image']['name'];  
    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];  
    $admin_ip = getIPAddress();    //getIPAddress();  it can be used to catch adminip if the project goes live. for now,to make a difference between admin ip i am adding  numbers
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name' OR admin_email='$email'";

$query_result = mysqli_query($con,$select_query);
$numRows = mysqli_num_rows($query_result);
if($numRows > 0 ){
    echo "<script>alert('this admin name or email exists already');</script>";
}elseif($password != $cPassword){
    echo "<script>alert('password does not match with confirm password');</script>";
   
}else{
    move_uploaded_file($admin_image_tmp, './admin_image/' . $admin_image);  
    $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password, admin_image, admin_address, admin_mobile)
                    VALUES ('$admin_name', '$email', '$password', '$admin_image', '$address', '$contact')";

    $sql = mysqli_query($con, $insert_query);
    if($sql){
        echo "<script>alert('admin details successfully inserted')</script>";
    }

}

}
?>