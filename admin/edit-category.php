
<?php
if(isset($_GET['edit_category'])){
$edit_category=$_GET['edit_category'];
//echo $edit_category;
$get_categories="Select * from `categories` where category_id=$edit_category"; 
$result=mysqli_query($con, $get_categories);
$row=mysqli_fetch_assoc($result);
$category_title=$row['category_title'];
echo $category_title;
}

if(isset($_POST['update_category'])){
$cat_title=$_POST['category_title'];
$update_query="update `categories` set category_title='$cat_title' where
category_id=$edit_category";
$result_cat=mysqli_query($con, $update_query);
if($result_cat){
echo "<script>alert('Category is been updated successfully')</script>";
echo "<script>window.open('./index.php?view_categories', '_self')</script>";
}
}
?>
<div class="container mt-3">
<h1 class="text-center text-success">
   edit category
</h1>
<form action="" method="post" class="text-center">
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="category_title" class="form-label"> Category Title</label>
        <input type="text" name="category_title" value="<?php echo $category_title ?>" id="title" class="form-control">
    </div>
    <input type="submit" value="Update Category" name="update_category" class="btn btn-outline-success">
</form>
</div>
