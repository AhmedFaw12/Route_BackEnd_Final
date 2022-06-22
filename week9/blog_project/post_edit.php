<?php
$active_link = "home";
require_once("header.php");

if (!empty($_GET["post_id"]) && ($user["role"] == 'admin' || $user["role"] == 'editor')) {

    $post_id = $_GET["post_id"];

    require_once("config.php");
    $cn = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, DB_PORT);

    //getting post from posts table by id, checking if created_by == user["id"] and user['role] !=admin
    if ($user['role'] != "admin") {
        $cond =  "and created_by = " . $user['id'];
    } else {
        $cond = "";
    }


    $qry = "select * from posts where id = $post_id $cond";
    $rslt = mysqli_query($cn, $qry);

    if ($post = mysqli_fetch_assoc($rslt)) {
    } else {
        header("location:home.php");//you can not edit
    }

    mysqli_close($cn);
} else {
    header("location:home.php");
}

?>

<!-- edit post -->
<div class="container mt-4">
    <h1>Edit Post</h1>
    <div class="row">
        <div class="col-md-8">
            <form action="post_update.php" method="POST" enctype="multipart/form-data">

                <!-- input hidden to send post_id to post_update.php -->
                <input type="hidden" name="post_id" value="<?=$post['id']?>">

                <input type="text" name="title" class="form-control m-1" placeholder="Post Title" value="<?= $post['title'] ?>">
                <textarea name="body" rows="5" class="form-control m-1" placeholder="Post Body"><?= $post['body'] ?></textarea>

                <input type="file" name="image" class="form-control m-1">
                <input type="submit" class="btn btn-light px-5 m-1" value="Save">
            </form>

        </div>
        <div class="col-md-4">
            <img class="img img-fluid m-1" src="<?=$post['image']?>" alt="">
        </div>
    </div>

</div>
<?php require_once("footer.php") ?>