<?php
$active = "Post Edit";
require_once("../header.php");
require_once("../config.php");
//(only admin , editors) can enter post_edit page
if (!($user["role"] == "admin" || $user["role"] == "editor")) {
    session_unset();
    header("location:../index.php?errors=secure_page");
}

//validate inputs
$errors = [];
if(empty($_REQUEST["post_id"])){
    $errors["post_id"] = "Post Id Is Required";
}

//check if post id exists , also check if post_owner == post_created_by
$qry = "select created_by from posts where id = ".$_REQUEST["post_id"];
$cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
$rslt = mysqli_query($cn, $qry);
if ($rslt) {
    if($post = mysqli_fetch_assoc($rslt)) {
        //check if post_owner == post_created_by
        if(empty($errors["post_id"]) && $post["created_by"] != $user["id"]){
            $errors["post_id"] = "You Are Not Authorized To Edit";
        }
    }else{
        //post not exists
        if(empty($errors["post_id"])) {
            $errors["post_id"] = "Post Does not Exist";
        }
    }
}
mysqli_close($cn);

$post_id = strip_tags(trim($_REQUEST["post_id"]));

//get old values to display
if(empty($errors)){
    $qry = "select id, title, body, image from posts where id=$post_id and created_by=".$user["id"];
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    $rslt = mysqli_query($cn, $qry);
    if($post = mysqli_fetch_assoc($rslt)){}
    mysqli_close($cn);


}else{
    $_SESSION["edit_errors"] = $errors;
    header("location:../home.php");
}
?>

<div class="container mt-4">
    <!-- Create Post UI -->
    <h1><?= $messages["Edit Post"] ?></h1>
    <div class="row">
        <div class="col-md-8">
            <form action="post_update.php" class="" method="POST" enctype="multipart/form-data">
                <!-- displaying success Messages -->
                <div class="text-success h2">
                    <strong>
                        <?php
                        if (!empty($_SESSION["success"]) && !empty($_SESSION["success"]["pending"])) {
                            echo $_SESSION["success"]["pending"];
                        }
                        if (!empty($_SESSION["success"]) && !empty($_SESSION["success"]["approved"])) {
                            echo $_SESSION["success"]["approved"];
                        }
                        ?>
                    </strong>
                </div>
                <!-- hidden input to send post_id -->
                <input type="hidden" name="post_id" value="<?php if(!empty($post["id"])) echo $post["id"]?>" >

                <!-- post_title -->
                <div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_title"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_title"])) echo $_SESSION['errors']["post_title"] ?>">

                    <input type="text" name="title" class="form-control mt-1" value="<?php if(!empty($post["title"])) echo $post["title"]?>" placeholder="<?= $messages["Post Title"] ?>">
                </div>

                <!-- post_body -->
                <div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_body"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_body"])) echo $_SESSION['errors']["post_body"] ?>">

                    <textarea name="body" rows="5" class="form-control mt-1" placeholder="<?= $messages["Post Body"] ?>"><?php if(!empty($post["body"])) echo $post["body"]?></textarea>
                </div>

                <!-- post-image -->
                <div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_image"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_image"])) echo $_SESSION['errors']["post_image"] ?>">

                    <input type="file" name="image" class="form-control mt-1">
                </div>
                <button class="btn btn-light mt-2 px-5" type="submit"><?= $messages["Save"] ?></button>
            </form>
        </div>
        <?php
        if(!empty($post["image"])){
        ?>
            <div class="col-md-4">
                <img class="img-fluid mt-1" src="../<?php  echo $post["image"]?>" alt="post_image">
            </div>
        <?php
        } 
        ?>
       
    </div>
</div>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["success"])) unset($_SESSION["success"]);
?>
<?php require_once("../footer.php"); ?>