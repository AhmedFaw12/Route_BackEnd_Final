<?php

$active_link = "users";
require_once("header.php");
?>

<div class="container fluid d-flex justify-content-center align-items-center mt-4">
    <!-- validate-form -->
    <form class="login100-form " action="users_store.php" method="POST">
        <span class="login100-form-title">
            Create New User
        </span>
        <!-- checking if there are errors -->
        <!-- Name -->
        <!-- adding alert-validate class, error_msg in data-validate attribute if there is error -->
        <div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) echo 'alert-validate'; ?>" data-validate="
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) echo $_SESSION['errors']['name']; ?>">

            <input class="input100" type="text" name="name" placeholder="Name" value="<?php 
            if (!empty($_SESSION['old_values']['name'])) {
                    echo $_SESSION['old_values']['name'];
            } ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>
        <!-- email -->
        <!-- adding alert-validate class, error_msg in data-validate attribute if there is error -->
        <div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) echo 'alert-validate'; ?>" data-validate="
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) echo $_SESSION['errors']['email']; ?>">


            <input class="input100" type="text" name="email" placeholder="Email" value="<?php 
            if (!empty($_SESSION['old_values']['email'])) {
                echo $_SESSION['old_values']['email'];
            } ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>
        <!-- mobile -->
        <div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['mobile'])) echo 'alert-validate'; ?>" data-validate="
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['mobile'])) echo $_SESSION['errors']['mobile']; ?>">

            <input class="input100" type="text" name="mobile" placeholder="Mobile" value="<?php 
            if (!empty($_SESSION['old_values']['mobile'])) {
                echo $_SESSION['old_values']['mobile'];
            } ?>">

            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-phone" aria-hidden="true"></i>
            </span>
        </div>
        <!-- password -->
        <div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass'])) echo 'alert-validate'; ?>" data-validate="
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass'])) echo $_SESSION['errors']['pass']; ?>">
            <input class="input100" type="password" name="pass" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        <!-- password-confirmation -->
        <div class="wrap-input100 validate-input 
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass_confirmation'])) echo 'alert-validate'; ?>" data-validate="
					<?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['pass_confirmation'])) echo $_SESSION['errors']['pass_confirmation']; ?>">
            <input class="input100" type="password" name="pass_confirmation" placeholder="Confirm Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        <!-- gender -->
        <div class="wrap-input100">
            <!-- male -->
            <input type="radio" name="gender" value="male" checked>
            <span>Male</span>
            <!-- female -->
            <input type="radio" name="gender" value="female"><span>Female</span>
        </div>

        <!-- role -->
        <div class="wrap-input100">
            <!-- admin -->
            <input type="radio" name="role" value="admin" checked>
            <span>Admin</span>
            <!-- editor -->
            <input type="radio" name="role" value="editor"><span>Editor</span>
        </div>


        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
               Save
            </button>
        </div>

        <div class="text-center p-t-50">
            <a class="txt2" href="index.php">
                Already Register
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
</div>

<?php require_once("footer.php"); ?>

<?php 
//we want the error msg remove when the user refresh the page
if(!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if(!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);

?>	