<?php

$username_session = $_SESSION['username'];
if (isset($_POST['delete'])) {
    $delete_query = "Delete from `user` where username='$username_session'";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        session_destroy();
        echo "<script>alert('Account Deleted successfully')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}
if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php', '_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .delete-btn{
            width: 400px;
            border: 2px solid;
        }
    </style>
</head>

<body>
    <form action="" method="post" class="d-flex align-items-center justify-content-center">
        <div>
            <input class="btn btn-outline-danger delete-btn" type="submit" value="Delete My Account" name="delete">
        </div>
    </form>
</body>

</html>