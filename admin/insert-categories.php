<?php
include('../include/connect.php');
if(isset($_POST['insert_cat'])){
     $category_title = $_POST['cat_title'];
    $select_category = "Select * from `categories` where category_title = '$category_title'";
    $result_select = mysqli_query($con,$select_category);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script> alert('this category is already in the list')</script>";
    }else{
        $insert_category = "insert into `categories` (category_title) values ('$category_title')";
        $result = mysqli_query($con,$insert_category);
        if($result){
            echo "<script> alert('category has been successfully added ')</script>";
        }
    }
       
    }
   

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title></title>
</head>

<body>
    <form action="" method="post">
        <div class="input-group p-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Insert Categories" aria-label="Username" name="cat_title" aria-describedby="basic-addon1">
        </div>

        <div class="input-group w-100 my-2 mx-3">
            <input type="submit" class="btn btn-info" placeholder="Insert Categories" aria-label="categories" value="insert categories" name="insert_cat" aria-describedby="basic-addon1">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>