<?php 
$active_link = "home";
require_once("header.php")

?>

  <!-- creating post -->
  <div class="container mt-4">
    <!-- making div appear only to admins and editors -->
    <?php
      if($user["role"] == 'admin' || $user["role"] == 'editor'){
      
    ?>
    <div>
      <h1><?=$messages["Make Post"]?></h1>
      <form action="post_create.php" method="POST" enctype="multipart/form-data">

        <input type="text" name="title" class="form-control m-1 mt-5" placeholder="<?=$messages["Post Title"]?>">

        <textarea name="body" rows="5" class="form-control m-1" placeholder="<?=$messages["Post Body"]?>"></textarea>

        <input type="file" name="image" class="form-control m-1">

        <input type="submit" class="btn btn-light px-5 m-1" value="<?=$messages["Post"]?>">
      </form>
    </div>
    <?php } ?>

    <!-- displaying user posts -->
    <div class="m-5">
      <?php

      //condition to display posts according to user role
      if ($user['role'] != "admin"){//for users , editors
          $status_cond = "status = 'approved'";
      } 
      else{
        $status_cond = "status in( 'pending','approved')";
      } 
      
      
      // getting all posts for all users
      $qry = "select p.id, p.title,p.body, p.image, p.created_by, p.status, p.action_by, p.created_at, u.name user_name
      from posts p join users u
      on(u.id = p.created_by)
      where $status_cond
      order by created_at desc";

      require_once("config.php");

      $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);

      $rslt = mysqli_query($cn, $qry);
      while ($post = mysqli_fetch_assoc($rslt)) {
      ?>

        <div class="row">
          <div class="col mx-2 my-1">
            <div class="card text-white bg-secondary">
              <img class="card-img-top" src=<?= $post["image"] ?> alt="">
              <div class="card-body">
                <h4 class="card-title"><?= $post["title"] ?></h4>
                <p class="card-text"><?= $post["body"] ?></p>
                <div class="d-flex justify-content-between">
                  <p class="card-text text-table-primary">Post by <?= $post["user_name"] ?> at <?= $post["created_at"] ?></p>
                  <div>


                    <!-- appearance of delete btn according to logged in user -->
                    <?php
                    if ($user['role'] == 'admin' && $post['status'] == 'pending') {
                    ?>
                      <a href="post_action.php?post_id=<?= $post['id'] ?>&action=approved" class="btn btn-sm btn-success">Approve</a>

                      <a href="post_action.php?post_id=<?= $post['id'] ?>&action=rejected" class="btn btn-sm btn-danger">Reject</a>
                    <?php
                    } elseif ($post['created_by'] == $user["id"] || $user['role'] == 'admin') {

                    ?>
                      <a href="post_delete.php?post_id=<?= $post['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                      
                      <?php
                    }
                    if($post['created_by'] == $user["id"]){//only person who created post can edit it
                      
                      ?>
                      <a href="post_edit.php?post_id=<?= $post['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }

      // echo mysqli_error($cn);
      mysqli_close($cn);
      ?>
    </div>

  </div>


<?php require_once("footer.php")?>