<h1 class="text-person text-success text-center">
    All Users
</h1>

<table class="table table-border mt-5">
    <thead>
        <tr>
            <th>User No</th>
            <th>Username</th></th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Address</th>
            <th>User Mobile</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_users = "SELECT * FROM `user`";
        $result = mysqli_query($con, $get_users);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_address = $row['user_address'];
            $user_mobile = $row['user_mobile'];
            $number++;
        ?>
            <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $user_email; ?></td>
                <td>
                    <img src='../user/user_image/<?php echo $user_image; ?>' style='height:60px' alt='null'>
                </td>
                <td><?php echo $user_address; ?></td>
                <td><?php echo $user_mobile ?></td>
                <td><a  data-bs-toggle="modal" data-bs-target="#exampleModal" href='index.php?delete_user=<?php echo $user_id; ?>'><i class='fa-solid fa-trash'></i></a></td>
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
      Do you really want delete the user?
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary"><a class="text-dark text-decoration-none" href="index.php?delete_user=<?php echo $user_id ?>">yes</a></button>
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><a class="text-dark text-decoration-none" href="./index.php?all_user">no</a></button>
      </div>
    </div>
  </div>
</div>