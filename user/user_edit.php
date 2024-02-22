<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_password = $row_fetch['user_password'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
}

if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name']; // Corrected
    move_uploaded_file($user_image_tmp, "./user_image/$user_image"); // Make sure the destination path is correct

    // update query
    $update_data = "UPDATE `user` SET username='$username', user_email='$user_email', user_password='$user_password', user_image='$user_image', 
    user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
    
    $result_query_update = mysqli_query($con, $update_data);
    
    if ($result_query_update) {
        echo "<script> alert('Data updated successfully')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Edit</title>
</head>

<body>

    <h1 class="text-center">Edit Account</h1>
    <div class="form-edit w-100 d-flex align-items-center justify-content-center">
        <form action="" method="post" enctype="multipart/form-data" style="width: 500px;">
            <div class="my-3 from-outline">
                <input class="form-control" value="<?php echo $username ?>" type="text" id="username" name="username">
            </div>
            <div class="my-3 from-outline">
                <input class="form-control" value="<?php echo $user_email ?>"  type="text" id="email" name="user_email">
            </div>
            <div class="my-3 from-outline">
                <input class="form-control" type="file" id="user_image" name="user_image">
                <img src="./user_image/<?php echo $row_image ?>" class="row-image" style="width:150px;object-fit:contain" alt="..">
            </div>
            <div class="my-3 from-outline">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" value="<?php echo $user_password ?>" type="password" id="password" name="password">
            </div>

            <div class="my-3 from-outline">
                <label class="form-label" for="address">Address:</label>
                <input class="form-control" value="<?php echo $user_address ?>"  type="text" id="address" name="user_address">
            </div>
            <div class="my-3 from-outline">
                <label class="form-label" for="contact">Contact:</label>
                <input class="form-control" value="<?php echo $user_mobile ?>" type="text" id="contact" name="user_mobile">
            </div>
            <div class="">
                <input type="submit" value="Update" class="btn btn-outline-success" name="user_update">
            </div>
        </form>
    </div>
</body>

</html>