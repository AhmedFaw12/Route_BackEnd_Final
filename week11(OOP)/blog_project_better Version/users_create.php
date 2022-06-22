<?php
$active = "Users Create";
require_once("header.php");
// //only admins can enter this page
// if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin") {
//     $user = $_SESSION["user"];
// } else {
//     session_unset();
//     header("location:index.php?errors=secure_page");
// }

?>

<!-- make user -->
<div class="container fluid d-flex justify-content-center align-items-center mt-5">
    
    <form class="login100-form " action="users_store.php" method="POST">
        
        <span class="login100-form-title">
            <?= $messages["Create New User"] ?>
        </span>

        <div class="text-success h2">
			<strong>
				<?php
				if (!empty($_SESSION["success"]) && !empty($_SESSION["success"]["User_Create"])) {
					echo $_SESSION["success"]["User_Create"];
				}
				?>
			</strong>
		</div>

        <!-- name -->
        <div class="wrap-input100 validate-input
					<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["name"])) echo "alert-validate" ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["name"])) echo $_SESSION['errors']["name"] ?>">

            <input class="input100" type="text" name="name" placeholder="<?= $messages["Name"] ?>" value="<?php if (!empty($_SESSION["old_values"]["name"])) echo $_SESSION["old_values"]["name"] ?>">

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user pr-1" aria-hidden="true"></i>
            </span>
        </div>

        <!-- email -->
        <div class="wrap-input100 validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["email"])) echo "alert-validate" ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["email"])) echo $_SESSION['errors']["email"] ?>">

            <input class="input100" type="text" name="email" placeholder="<?= $messages["Email"] ?>" value="<?php if (!empty($_SESSION["old_values"]["email"])) echo $_SESSION["old_values"]["email"] ?>">

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope pr-1" aria-hidden="true"></i>
            </span>
        </div>
        <!-- mobile -->
        <div class="wrap-input100 validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["mobile"])) echo "alert-validate" ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["mobile"])) echo $_SESSION['errors']["mobile"] ?>">

            <input class="input100" type="text" name="mobile" placeholder="<?= $messages["Mobile"] ?>" value="<?php if (!empty($_SESSION["old_values"]["mobile"])) echo $_SESSION["old_values"]["mobile"] ?>">

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-phone pr-1" aria-hidden="true"></i>
            </span>
        </div>
        <!-- password -->
        <div class="wrap-input100 validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["password"])) echo "alert-validate" ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["password"])) echo $_SESSION['errors']["password"] ?>">
            <input class="input100" type="password" name="pass" placeholder="<?= $messages["Password"] ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock pr-1" aria-hidden="true"></i>
            </span>
        </div>
        <!--confirm password -->
        <div class="wrap-input100 validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["confirm_password"])) echo "alert-validate" ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["confirm_password"])) echo $_SESSION['errors']["confirm_password"] ?>">

            <input class="input100" type="password" name="confirm_pass" placeholder="<?= $messages["Confirm Password"] ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock pr-1" aria-hidden="true"></i>
            </span>
        </div>
        
        <!--gender -->
        <div class="wrap-input100">
            <!-- male -->
            <input type="radio" name="gender" value="male" checked>
            <span><?= $messages["male"] ?></span>
            <!-- female -->
            <input type="radio" name="gender" value="female">
            <span><?= $messages["female"] ?></span>
        </div>
        
        <!--role -->
        <div class="wrap-input100">
            <!-- admin -->
            <input type="radio" name="role" value="admin" checked>
            <span><?=$messages["Admin"]?></span>
            <!-- editor-->
            <input type="radio" name="role" value="editor">
            <span><?= $messages["Editor"] ?></span>
        </div>


        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                <?= $messages["Save"] ?>
            </button>
        </div>
    </form>
</div>

<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
if (!empty($_SESSION["success"])) unset($_SESSION["success"]);
?>


<?php require_once("footer.php"); ?>