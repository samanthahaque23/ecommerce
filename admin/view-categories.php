<h1 class="text-center text-success">
    view categories
</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select = "select * from `categories`";
        $result = mysqli_query($con, $select);
        $num = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $num++;
        ?>

            <tr>
                <td><?php echo $num ?></td>
                <td><?php echo $category_title ?></td>
                <td><a href="index.php?edit_category=<?php echo $category_id ?>"><i class="fa-solid fa-pen"></i></a></td>
                <td><a href="index.php?delete_category=<?php echo $category_id ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></a></td>
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body">
      Do you really want delete the category?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary"><a class="text-dark text-decoration-none" href="index.php?delete_category=<?php echo $category_id ?>">yes</a></button>
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><a class="text-dark text-decoration-none" href="./index.php?view_categories">no</a></button>
      </div>
    </div>
  </div>
</div>