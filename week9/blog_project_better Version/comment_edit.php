<?php
$active = "Comment Edit";
require_once("header.php");
require_once("config.php");

//validate inputs
$errors = [];
if (empty($_REQUEST["post_id"])) {
    $errors["post"] = "Empty Post id";
}

if (empty($_REQUEST["comment_id"])) {
    $errors["comment"] = "Comment Id Is Required";
}

$post_id = strip_tags(trim($_REQUEST["post_id"]));
$comment_id = strip_tags(trim($_REQUEST["comment_id"]));


//get old values to display
if (empty($errors)) {

    //only comment owner can edit comment
    $qry = "select id, comment from comments where id = $comment_id and post_id = $post_id and user_id =" . $user["id"];
    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
    $rslt = mysqli_query($cn, $qry);
    if ($comment = mysqli_fetch_assoc($rslt)) {
    }
    mysqli_close($cn);
} else {
    $_SESSION["edit_errors"] = $errors;
    header("location:home.php");
}
?>

<div class="container mt-4">
    <!-- Create Post UI -->
    <h1><?= $messages["Edit Comment"] ?></h1>
    <!-- Entering comment -->
    <form id="comment_form" action="comment_update.php" class="" method="POST">
            <div class="row w-100 mt-3">
                <div class="col-md-8">

                    <input type="hidden" name="comment_id" value="<?php if(!empty($comment["id"])) echo $comment["id"]?>" >
                    
                    <!-- hidden input to send post_id -->
                    <input type="hidden" name="post_id" value="<?php if (!empty($post_id)) echo $post_id ?>">

                    <div class="validate-input  <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["comment"])) echo "alert-validate "; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["comment"])) echo $_SESSION["errors"]["comment"];?>">

                        <textarea id="comment" name="comment" rows="2" class="form-control cmt-class mt-1" placeholder="<?= $messages["Enter Your Comment"] ?>"><?=$comment["comment"]?></textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-sm btn-light mt-2" type="submit"><?= $messages["Comment"] ?></button>
    </form>
</div>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["success"])) unset($_SESSION["success"]);
?>
<?php require_once("footer.php"); ?>