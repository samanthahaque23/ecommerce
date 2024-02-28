
<?php
if(isset($_GET['edit_brands'])){
$edit_brands=$_GET['edit_brands'];
//echo $edit_brands;
$get_brands="Select * from `brands` where brands_id=$edit_brands"; 
$result=mysqli_query($con, $get_brands);
$row=mysqli_fetch_assoc($result);
$brands_title=$row['brands_title'];
echo $brands_title;
}
if(isset($_POST['update_brands'])){
    $cat_title=$_POST['brands_title'];
    $update_query="update `brands` set brands_title='$cat_title' where
    brands_id=$edit_brands";
    $result_cat=mysqli_query($con, $update_query);
    if($result_cat){
    echo "<script>alert('Brands is been updated successfully')</script>";
    echo "<script>window.open('./index.php?view-brands', '_self')</script>";
    }
    }

?>
<div class="container mt-3">
<h1 class="text-center text-success">
   edit brands
</h1>
<form action="" method="post" class="text-center">
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="brands_title" class="form-label"> Brands Title</label>
        <input type="text" name="brands_title" value="<?php echo $brands_title ?>" id="title" class="form-control">
    </div>
    <input type="submit" value="Update Brands" name="update_brands" class="btn btn-outline-success">
</form>
</div>
